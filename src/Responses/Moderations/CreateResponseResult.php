<?php

declare(strict_types=1);

namespace OpenAI\Responses\Moderations;

use OpenAI\Enums\Moderations\Category;

final class CreateResponseResult
{
    /**
     * @param  array<string, CreateResponseCategory>  $categories
     * @param  array<string, array<string>>  $categoryAppliedInputTypes
     */
    private function __construct(
        public readonly array $categories,
        public readonly bool $flagged,
        public readonly ?array $categoryAppliedInputTypes,
    ) {
        // ..
    }

    /**
     * @param  array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool, category_applied_input_types?: array<string, array<int, string>>}  $attributes
     */
    public static function from(array $attributes): self
    {
        /** @var array<string, CreateResponseCategory> $categories */
        $categories = [];

        foreach (Category::cases() as $category) {
            if (! isset($attributes['category_scores'][$category->value])) {
                continue;
            }

            $categories[$category->value] = CreateResponseCategory::from([
                'category' => $category->value,
                'violated' => $attributes['categories'][$category->value],
                'score' => $attributes['category_scores'][$category->value],
            ]);
        }

        return new CreateResponseResult(
            $categories,
            $attributes['flagged'],
            $attributes['category_applied_input_types'] ?? null,
        );
    }

    /**
     * @return array{ categories: array<string, bool>, category_scores: array<string, float>, flagged: bool, category_applied_input_types?: array<string, array<int, string>>}
     */
    public function toArray(): array
    {
        $categories = [];
        $categoryScores = [];
        foreach ($this->categories as $category) {
            $categories[$category->category->value] = $category->violated;
            $categoryScores[$category->category->value] = $category->score;
        }

        $result = [
            'categories' => $categories,
            'category_scores' => $categoryScores,
            'flagged' => $this->flagged,
        ];

        if ($this->categoryAppliedInputTypes !== null) {
            $result['category_applied_input_types'] = $this->categoryAppliedInputTypes;
        }

        return $result;
    }
}
