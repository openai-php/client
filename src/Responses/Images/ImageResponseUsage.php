<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

final class ImageResponseUsage
{
    private function __construct(
        public readonly int $totalTokens,
        public readonly ?int $inputTokens,
        public readonly ?int $outputTokens,
        public readonly ?ImageResponseUsageInputTokensDetails $inputTokensDetails,
    ) {}

    /**
     * @param  array{total_tokens: int, input_tokens?: int, output_tokens?: int, input_tokens_details?: array{text_tokens: int, image_tokens: int}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            totalTokens: $attributes['total_tokens'],
            inputTokens: $attributes['input_tokens'] ?? null,
            outputTokens: $attributes['output_tokens'] ?? null,
            inputTokensDetails: isset($attributes['input_tokens_details'])
                ? ImageResponseUsageInputTokensDetails::from($attributes['input_tokens_details'])
                : null,
        );
    }

    /**
     * @return array{total_tokens: int, input_tokens: int|null, output_tokens: int|null, input_tokens_details: array{text_tokens: int, image_tokens: int}|null}
     */
    public function toArray(): array
    {
        return [
            'total_tokens' => $this->totalTokens,
            'input_tokens' => $this->inputTokens,
            'output_tokens' => $this->outputTokens,
            'input_tokens_details' => $this->inputTokensDetails?->toArray(),
        ];
    }
}
