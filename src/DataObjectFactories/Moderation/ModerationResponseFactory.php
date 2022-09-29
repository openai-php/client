<?php

namespace OpenAI\DataObjectFactories\Moderation;

use OpenAI\DataObjects\Moderation\ModerationResponse;

final class ModerationResponseFactory
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public static function new(array $attributes): ModerationResponse
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function make(array $attributes): ModerationResponse
    {
        return new ModerationResponse(
            id: strval($attributes['id']),
            model: strval($attributes['model']),
            results: ModerationResultFactory::collection($attributes['results'] ?? []), /* @phpstan-ignore-line */
        );
    }
}
