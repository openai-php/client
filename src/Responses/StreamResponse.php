<?php

namespace OpenAI\Responses;

use Generator;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\ResponseStreamContract;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Responses\Meta\MetaInformation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @template TResponse
 *
 * @implements ResponseStreamContract<TResponse>
 */
final class StreamResponse implements ResponseHasMetaInformationContract, ResponseStreamContract
{
    private const STREAM_READ_SIZE = 64 * 1024;

    private string $lineBuffer = '';

    /**
     * Creates a new Stream Response instance.
     *
     * @param  class-string<TResponse>  $responseClass
     */
    public function __construct(
        private readonly string $responseClass,
        private readonly ResponseInterface $response,
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): Generator
    {
        $body = $this->response->getBody();
        $event = null;

        while (($line = $this->readLine($body)) !== null) {
            if (str_starts_with($line, 'event:')) {
                $event = trim(substr($line, strlen('event:')));

                unset($line);

                continue;
            }

            if (! str_starts_with($line, 'data:')) {
                $event = null;

                unset($line);

                continue;
            }

            $data = substr($line, strlen('data:'));

            unset($line);

            if (strlen($data) <= 16 && trim($data) === '[DONE]') {
                unset($data);

                break;
            }

            /** @var array{error?: array{message: string|array<int, string>, type: string, code: string}, type?: string} $attributes */
            $attributes = json_decode($data, true, flags: JSON_THROW_ON_ERROR);

            unset($data);

            if (isset($attributes['error'])) {
                throw new ErrorException($attributes['error'], $this->response);
            }

            $skippableTypes = ['ping', 'keepalive', 'response.keep_alive'];

            if (isset($attributes['type']) && in_array($attributes['type'], $skippableTypes, true)) {
                $event = null;

                unset($attributes);

                continue;
            }

            if ($event !== null) {
                $attributes['__event'] = $event;
            }

            $attributes['__meta'] = $this->meta();

            $streamEvent = $this->responseClass::from($attributes);

            $event = null;

            unset($attributes);

            yield $streamEvent;

            unset($streamEvent);
        }
    }

    /**
     * Read a line from the stream.
     */
    private function readLine(StreamInterface $stream): ?string
    {
        $newLinePosition = strpos($this->lineBuffer, "\n");

        if ($newLinePosition !== false) {
            $lineLength = $newLinePosition + 1;

            if ($lineLength === strlen($this->lineBuffer)) {
                $line = $this->lineBuffer;
                $this->lineBuffer = '';

                return $line;
            }

            $line = substr($this->lineBuffer, 0, $lineLength);
            $this->lineBuffer = substr($this->lineBuffer, $lineLength);

            return $line;
        }

        while (! $stream->eof()) {
            $chunk = $stream->read(self::STREAM_READ_SIZE);

            if ($chunk === '') {
                continue;
            }

            // Split the fresh chunk before appending it to avoid copying a large buffered line.
            $newLinePosition = strpos($chunk, "\n");

            if ($newLinePosition === false) {
                $this->lineBuffer .= $chunk;

                continue;
            }

            $lineLength = $newLinePosition + 1;
            $line = $this->lineBuffer;
            $this->lineBuffer = substr($chunk, $lineLength);

            if ($lineLength === strlen($chunk)) {
                $line .= $chunk;
            } else {
                $line .= substr($chunk, 0, $lineLength);
            }

            return $line;
        }

        if ($this->lineBuffer === '') {
            return null;
        }

        $line = $this->lineBuffer;
        $this->lineBuffer = '';

        return $line;
    }

    public function meta(): MetaInformation
    {
        return MetaInformation::from($this->response->getHeaders());
    }
}
