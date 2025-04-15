<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

final class OutputMessageContent
{
    private function __construct(
        public readonly array $content,
        public readonly string $id,
        public readonly string $role,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  array{reasoning_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['reasoning_tokens'],
        );
    }

    /**
     * @return array{reasoning_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'reasoning_tokens' => $this->reasoningTokens,
        ];
    }
}
