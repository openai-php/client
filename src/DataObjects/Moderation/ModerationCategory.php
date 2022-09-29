<?php

namespace OpenAI\DataObjects\Moderation;

use OpenAI\Enums\Moderation\Category;

final class ModerationCategory
{
    public function __construct(
        public readonly Category $category,
        public readonly bool $violated,
        public readonly float $score,
    ) {
    }

    /**
     * @return array<string, string|float|bool>
     */
    public function toArray(): array
    {
        return [
            'category' => $this->category->value,
            'violated' => $this->violated,
            'score' => $this->score,
        ];
    }
}
