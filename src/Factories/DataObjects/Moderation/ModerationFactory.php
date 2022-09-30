<?php

namespace OpenAI\Factories\DataObjects\Moderation;

use OpenAI\DataObjects\Moderation\Moderation;

final class ModerationFactory
{
    /**
     * @param  array<string, array<array-key, array<string, array<string, bool|float>>>|string>  $attributes
     */
    public static function new(array $attributes): Moderation
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, array<array-key, array<string, array<string, bool|float>>>|string>  $attributes
     */
    public function make(array $attributes): Moderation
    {
        return new Moderation(
            id: strval($attributes['id']),
            model: strval($attributes['model']),
            results: ModerationResultFactory::collection($attributes['results']), /** @phpstan-ignore-line */
        );
    }
}
