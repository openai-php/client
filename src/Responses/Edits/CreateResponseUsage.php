<?php

declare(strict_types=1);

namespace OpenAI\Responses\Edits;

final class CreateResponseUsage
{
    private function __construct(
        public readonly int $promptTokens,
        public readonly int $completionTokens,
        public readonly int $totalTokens,
    ) {
    }

    /**
     * @param  array{prompt_tokens: int, completion_tokens: int, total_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['prompt_tokens'],
            $attributes['completion_tokens'],
            $attributes['total_tokens'],
        );
    }

    /**
     * @return array{prompt_tokens: int, completion_tokens: int, total_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'total_tokens' => $this->totalTokens,
        ];
    }
}
