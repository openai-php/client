<?php

namespace OpenAI\Responses;

use Generator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @template T
 */
final class StreamResponse
{
    /**
     * @param  class-string<T>  $responseClass
     */
    public function __construct(
        private readonly string $responseClass,
        private readonly ResponseInterface $response,
    ) {
    }

    /**
     * @return Generator<array-key, mixed, T, T>
     */
    public function read(): Generator
    {
        while (! $this->response->getBody()->eof()) {
            $line = $this->readLine($this->response->getBody());

            if (! str_starts_with($line, 'data:')) {
                continue;
            }

            $data = trim(substr($line, strlen('data:')));

            if ($data === '[DONE]') {
                break;
            }

            $reponse = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

            yield $this->responseClass::from($reponse);
        }
    }

    private function readLine(StreamInterface $stream): string
    {
        $buffer = '';

        while (! $stream->eof()) {
            if ('' === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;
            if ($byte === "\n") {
                break;
            }
        }

        return $buffer;
    }
}
