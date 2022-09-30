<?php

namespace OpenAI\Factories\DataObjects\Moderation;

use OpenAI\DataObjects\Moderation\ModerationResult;
use OpenAI\Enums\Moderation\Category;

final class ModerationResultFactory
{
    /**
     * @param  array<array-key, array<string, array<string, bool|float>>>  $results
     * @return ModerationResult[]
     */
    public static function collection(array $results): array
    {
        return array_map(fn ($result): ModerationResult => static::new($result), $results);
    }

    /**
     * @param  array<string, array<string, bool|float>>  $attributes
     */
    public static function new(array $attributes): ModerationResult
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, array<string, bool|float>>  $attributes
     */
    public function make(array $attributes): ModerationResult
    {
        $categories = array_map(fn (Category $category): array => [
            'category' => $category->value,
            'violated' => $attributes['categories'][$category->value],
            'score' => $attributes['category_scores'][$category->value],
        ], Category::cases());

        return new ModerationResult(
            categories: ModerationCategoryFactory::collection($categories),
            flagged: (bool) ($attributes['flagged']),
        );
    }
}
