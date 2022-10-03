<?php

declare(strict_types=1);

namespace OpenAI\Responses\Moderations;

use OpenAI\Enums\Moderations\Category;

final class CreateResponseResult
{
    /**
     * @param  array<string, CreateResponseCategory>  $categories
     */
    private function __construct(
        public readonly array $categories,
        public readonly bool $flagged,
    ) {
        // ..
    }

    /**
     * @param  array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        /** @var array<string, CreateResponseCategory> $categories */
        $categories = [];

        foreach (Category::cases() as $category) {
            $categories[$category->value] = CreateResponseCategory::from([
                'category' => $category->value,
                'violated' => $attributes['categories'][$category->value],
                'score' => $attributes['category_scores'][$category->value],
            ]);
        }

        return new CreateResponseResult(
            $categories,
            $attributes['flagged']
        );
    }

    /**
     * @return array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}
     */
    public function toArray(): array
    {
        $categories = [];
        $categoryScores = [];
        foreach ($this->categories as $category) {
            $categories[$category->category->value] = $category->violated;
            $categoryScores[$category->category->value] = $category->score;
        }

        return [
            'categories' => $categories,
            'category_scores' => $categoryScores,
            'flagged' => $this->flagged,
        ];
    }
}
