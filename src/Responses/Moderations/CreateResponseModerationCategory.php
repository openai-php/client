<?php

declare(strict_types=1);

namespace OpenAI\Responses\Moderations;

use OpenAI\Enums\Moderation\Category;

final class CreateResponseModerationCategory
{
    public function __construct(
        public readonly Category $category,
        public readonly bool $violated,
        public readonly float $score,
    ) {
    }
}
