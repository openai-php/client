<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type InputTokenDetailsType from CreateResponseUsageInputTokenDetails
 * @phpstan-import-type OutputTokenDetailsType from CreateResponseUsageOutputTokenDetails
 *
 * @phpstan-type UsageType array{input_tokens: int, input_tokens_details: InputTokenDetailsType, output_tokens: int, output_tokens_details: OutputTokenDetailsType, total_tokens: int}
 *
 * @implements ResponseContract<UsageType>
 */
final class CreateResponseUsage implements ResponseContract
{
    /**
     * @use ArrayAccessible<UsageType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $inputTokens,
        public readonly CreateResponseUsageInputTokenDetails $inputTokensDetails,
        public readonly int $outputTokens,
        public readonly CreateResponseUsageOutputTokenDetails $outputTokensDetails,
        public readonly int $totalTokens,
    ) {}

    /**
     * @param  UsageType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            inputTokens: $attributes['input_tokens'],
            inputTokensDetails: CreateResponseUsageInputTokenDetails::from($attributes['input_tokens_details']),
            outputTokens: $attributes['output_tokens'],
            outputTokensDetails: CreateResponseUsageOutputTokenDetails::from($attributes['output_tokens_details']),
            totalTokens: $attributes['total_tokens'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'input_tokens' => $this->inputTokens,
            'input_tokens_details' => $this->inputTokensDetails->toArray(),
            'output_tokens' => $this->outputTokens,
            'output_tokens_details' => $this->outputTokensDetails->toArray(),
            'total_tokens' => $this->totalTokens,
        ];
    }
}
