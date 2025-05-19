<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;
use OpenAI\Responses\Images\ImageResponseUsageInputTokensDetails;

/**
 * @implements ResponseContract<array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}>
 */
final class ImageResponseUsage implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}>
     */
    use ArrayAccessible;
    use Fakeable;

    private function __construct(
        public readonly int $totalTokens,
        public readonly int $inputTokens,
        public readonly int $outputTokens,
        public readonly ImageResponseUsageInputTokensDetails $inputTokensDetails,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $inputTokensDetails = ImageResponseUsageInputTokensDetails::from($attributes['input_tokens_details']);

        return new self(
            $attributes['total_tokens'],
            $attributes['input_tokens'],
            $attributes['output_tokens'],
            $inputTokensDetails,
        );
    }

    /**
     * {@inheritDoc}
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