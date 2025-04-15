<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseUsage
{
    private function __construct(
        public readonly int $inputTokens,
        public readonly ?int $outputTokens,
        public readonly int $totalTokens,
        public readonly CreateResponseUsageInputTokenDetails $inputTokensDetails,
        public readonly CreateResponseUsageOutputTokenDetails $outputTokensDetails,
    ) {}

    /**
     * @param  array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens?: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['input_tokens'],
            $attributes['output_tokens'] ?? 0,
            $attributes['total_tokens'],
            CreateResponseUsageInputTokenDetails::from($attributes['input_tokens_details']),
            CreateResponseUsageOutputTokenDetails::from($attributes['output_tokens_details']),
        );
    }

    /**
     * @return array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'input_tokens' => $this->inputTokens,
            'input_tokens_details' => $this->inputTokensDetails->toArray(),
            'output_tokens' => $this->outputTokens ?? 0,
            'output_tokens_details' => $this->outputTokensDetails->toArray(),
            'total_tokens' => $this->totalTokens,
        ];
    }
}
