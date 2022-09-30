<?php

namespace OpenAI\Factories\DataObjects\Moderation;

use OpenAI\DataObjects\Moderation\ModerationCategory;
use OpenAI\Enums\Moderation\Category;

final class ModerationCategoryFactory
{
    /**
     * @param  array<array-key, array<string, bool|float|string>>  $results
     * @return ModerationCategory[]
     */
    public static function collection(array $results): array
    {
        return array_map(fn ($result): ModerationCategory => static::new($result), $results);
    }

    /**
     * @param  array<string, bool|float|string>  $attributes
     */
    public static function new(array $attributes): ModerationCategory
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, bool|float|string>  $attributes
     */
    public function make(array $attributes): ModerationCategory
    {
        return new ModerationCategory(
            category: Category::from((string) $attributes['category']),
            violated: (bool) $attributes['violated'],
            score: (float) $attributes['score'],
        );
    }
}
