<?php

declare(strict_types=1);

namespace OpenAI\Factories\Responses\Moderations;

use OpenAI\Enums\Moderation\Category;
use OpenAI\Responses\Moderations\CreateResponseModerationCategory;

final class CreateResponseModerationCategoryFactory
{
    /**
     * @param  array<array-key, array<string, bool|float|string>>  $results
     * @return CreateResponseModerationCategory[]
     */
    public static function collection(array $results): array
    {
        return array_map(fn ($result): CreateResponseModerationCategory => static::new($result), $results);
    }

    /**
     * @param  array<string, bool|float|string>  $attributes
     */
    public static function new(array $attributes): CreateResponseModerationCategory
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, bool|float|string>  $attributes
     */
    public function make(array $attributes): CreateResponseModerationCategory
    {
        return new CreateResponseModerationCategory(
            category: Category::from((string) $attributes['category']),
            violated: (bool) $attributes['violated'],
            score: (float) $attributes['score'],
        );
    }
}
