<?php

namespace OpenAI\Responses\Moderations;

final class CreateResponseModerationResult
{
    /**
     * @param  array<array-key, CreateResponseModerationCategory>  $categories
     */
    public function __construct(
        public readonly array $categories,
        public readonly bool $flagged,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $categories = [];
        $category_scores = [];
        foreach ($this->categories as $category) {
            $categories[$category->category->value] = $category->violated;
            $category_scores[$category->category->value] = $category->score;
        }

        return [
            'categories' => $categories,
            'category_scores' => $category_scores,
            'flagged' => $this->flagged,
        ];
    }
}
