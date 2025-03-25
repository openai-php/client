<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseStreamContract;
use OpenAI\Responses\StreamResponse;
use OpenAI\Testing\Resources\Responses;
use Psr\Http\Message\ResponseInterface;
use OpenAI\Responses\Responses\PartialResponses\CreatedPartialResponse;

/**
 * @implements ResponseStreamContract<CreatedPartialResponse>
 */
final class CreateStreamedResponse extends StreamResponse implements ResponseStreamContract
{
    protected static function partialResponseClass(): string
    {
        return CreatedPartialResponse::class;
    }

    /**
     * @return \Generator<CreatedPartialResponse>
     */
    public static function fromResponse(ResponseInterface $response): \Generator
    {
        foreach (self::decodeStream($response) as $line) {
            yield CreatedPartialResponse::from(json_decode($line, true, 512, JSON_THROW_ON_ERROR), []);
        }
    }

    /**
     * @param  callable(CreatedPartialResponse): void  $callback
     */
    public static function stream(ResponseInterface $response, callable $callback): void
    {
        foreach (self::decodeStream($response) as $line) {
            $callback(CreatedPartialResponse::from(json_decode($line, true, 512, JSON_THROW_ON_ERROR), []));
        }
    }
}