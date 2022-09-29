<?php

namespace OpenAI\DataObjects\Moderation;

use OpenAI\Contracts\DataObject;

final class ModerationResult implements DataObject
{
    /**
     * @param  array<array-key, ModerationCategory>  $categories
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
        return [
            'categories' => array_map(fn (ModerationCategory $category): array => $category->toArray(), $this->categories),
            'flagged' => $this->flagged,
        ];
    }
}
