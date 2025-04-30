<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

final class ImageResponseUsage
{
    private function __construct(
        public readonly int $totalTokens,
        public readonly int $inputTokens,
        public readonly int $outputTokens,
        public readonly ImageResponseUsageInputTokensDetails $inputTokensDetails,
    ) {}

    /**
     * @param  array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['total_tokens'],
            $attributes['input_tokens'],
            $attributes['output_tokens'],
            ImageResponseUsageInputTokensDetails::from($attributes['input_tokens_details']),
        );
    }

    /**
     * @return array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}
     */
    public function toArray(): array
    {
        return [
            'total_tokens' => $this->totalTokens,
            'input_tokens' => $this->inputTokens,
            'output_tokens' => $this->outputTokens,
            'input_tokens_details' => $this->inputTokensDetails->toArray(),
        ];
    }
}
