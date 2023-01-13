<?php

namespace OpenAI\Streams;

use Generator;
use GuzzleHttp\Psr7\Utils;
use OpenAI\Contracts\Stream;
use Psr\Http\Message\StreamInterface;

final class EventStream implements Stream
{
    public function __construct(
        private readonly StreamInterface $stream,
    ) {
    }

    /**
     * Iterates over the event-stream data.
     *
     * @return Generator<integer, string>
     */
    public function read(): Generator
    {
        while (! $this->stream->eof()) {
            $line = Utils::readLine($this->stream);

            if (! str_starts_with($line, 'data:')) {
                continue;
            }

            $data = trim(substr((string) strstr($line, 'data:'), 5));

            if ($data === '[DONE]') {
                break;
            }

            yield $data;
        }
    }
}
