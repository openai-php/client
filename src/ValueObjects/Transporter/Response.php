<?php

namespace OpenAI\ValueObjects\Transporter;

use Generator;
use JsonException;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\Streams\EventStream;
use Psr\Http\Message\ResponseInterface;

final class Response
{
    /**
     * Creates a new Response value object.
     */
    public function __construct(private readonly ResponseInterface $response)
    {
    }

    /**
     * Determines whether the stream response was requested.
     */
    public function isStream(): bool
    {
        return $this->response->getHeaderLine('Content-Type') === 'text/event-stream';
    }

    /**
     * Returns decoded response object.
     *
     * @return array<string, scalar>
     */
    public function object(): array
    {
        return $this->decode($this->response->getBody()->getContents());
    }

    /**
     * Returns stream generator with decoded response objects.
     *
     * @return Generator<integer, array<array-key, scalar>>
     */
    public function stream(): Generator
    {
        foreach ((new EventStream($this->response->getBody()))->read() as $data) {
            yield $this->decode($data);
        }
    }

    /**
     * Decode raw content to json.
     *
     * @return array<array-key, scalar>
     */
    private function decode(string $contents): array
    {
        $result = [];

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $result */
            $result = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        if (isset($result['error'])) {
            throw new ErrorException($result['error']);
        }

        return $result;
    }
}
