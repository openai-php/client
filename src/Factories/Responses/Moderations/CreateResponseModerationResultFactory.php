<?php

declare(strict_types=1);

namespace OpenAI\Factories\Responses\Moderations;

use OpenAI\Enums\Moderation\Category;
use OpenAI\Responses\Moderations\CreateResponseModerationResult;

final class CreateResponseModerationResultFactory
{
    /**
     * @param  array<array-key, array<string, array<string, bool|float>>>  $results
     * @return CreateResponseModerationResult[]
     */
    public static function collection(array $results): array
    {
        return array_map(fn ($result): CreateResponseModerationResult => static::new($result), $results);
    }

    /**
     * @param  array<string, array<string, bool|float>>  $attributes
     */
    public static function new(array $attributes): CreateResponseModerationResult
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, array<string, bool|float>>  $attributes
     */
    public function make(array $attributes): CreateResponseModerationResult
    {
        $categories = array_map(fn (Category $category): array => [
            'category' => $category->value,
            'violated' => $attributes['categories'][$category->value],
            'score' => $attributes['category_scores'][$category->value],
        ], Category::cases());

        return new CreateResponseModerationResult(
            categories: CreateResponseModerationCategoryFactory::collection($categories),
            flagged: (bool) ($attributes['flagged']),
        );
    }
}
