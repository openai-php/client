<?php

namespace OpenAI\Streams;

use GuzzleHttp\Psr7\Utils;
use JsonException;
use OpenAI\Contracts\Stream;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\UnserializableResponse;
use Psr\Http\Message\StreamInterface;

final class EventStream implements Stream
{
    public function __construct(
        private readonly StreamInterface $stream,
    ) {
    }

    public function read(): iterable
    {
        while (! $this->stream->eof()) {
            $line = Utils::readLine($this->stream);

            if (! str_starts_with($line, 'data:')) {
                continue;
            }

            $rawData = substr(strstr($line, 'data: '), 6);

            if ($rawData === "[DONE]\n") {
                break;
            }

            try {
                $data = json_decode($rawData, true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $jsonException) {
                throw new UnserializableResponse($jsonException);
            }

            if (isset($data['error'])) {
                throw new ErrorException($data['error']);
            }

            yield $data;
        }
    }
}
