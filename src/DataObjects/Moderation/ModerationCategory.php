<?php

namespace OpenAI\DataObjects\Moderation;

use OpenAI\Contracts\DataObject;
use OpenAI\Enums\Moderation\Category;

final class ModerationCategory implements DataObject
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
