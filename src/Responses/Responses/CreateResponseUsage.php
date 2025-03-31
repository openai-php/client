<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseUsage
{
    private function __construct(
        public readonly int $inputTokens,
        public readonly ?int $outputTokens,
        public readonly int $totalTokens,
    ) {}

    /**
     * @param  array{input_tokens: int, output_tokens?: int, total_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['input_tokens'],
            $attributes['output_tokens'] ?? 0,
            $attributes['total_tokens'],
        );
    }

    /**
     * @return array{input_tokens: int, output_tokens: int, total_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'input_tokens' => $this->inputTokens,
            'output_tokens' => $this->outputTokens ?? 0,
            'total_tokens' => $this->totalTokens,
        ];
    }
}