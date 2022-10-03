<?php

declare(strict_types=1);

namespace OpenAI\Factories\Responses\Moderations;

use OpenAI\Responses\Moderations\CreateResponse;

final class CreateResponseFactory
{
    /**
     * @param  array<string, array<array-key, array<string, array<string, bool|float>>>|string>  $attributes
     */
    public static function new(array $attributes): CreateResponse
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, array<array-key, array<string, array<string, bool|float>>>|string>  $attributes
     */
    public function make(array $attributes): CreateResponse
    {
        return new CreateResponse(
            id: strval($attributes['id']),
            model: strval($attributes['model']),
            results: CreateResponseModerationResultFactory::collection($attributes['results']), /** @phpstan-ignore-line */
        );
    }
}
