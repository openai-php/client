<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseUsageCompletionTokensDetails
{
    private function __construct(
        public readonly ?int $audioTokens,
        public readonly ?int $reasoningTokens,
        public readonly ?int $acceptedPredictionTokens,
        public readonly ?int $rejectedPredictionTokens
    ) {}

    /**
     * @param  array{audio_tokens?:int, reasoning_tokens?:int, accepted_prediction_tokens?:int, rejected_prediction_tokens?:int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['audio_tokens'] ?? null,
            $attributes['reasoning_tokens'] ?? null,
            $attributes['accepted_prediction_tokens'] ?? null,
            $attributes['rejected_prediction_tokens'] ?? null,
        );
    }

    /**
     * @return array{audio_tokens?:int, reasoning_tokens?:int, accepted_prediction_tokens?:int, rejected_prediction_tokens?:int}
     */
    public function toArray(): array
    {
        $result = [];

        if ($this->audioTokens !== null) {
            $result['audio_tokens'] = $this->audioTokens;
        }

        if ($this->reasoningTokens !== null) {
            $result['reasoning_tokens'] = $this->reasoningTokens;
        }

        if ($this->acceptedPredictionTokens !== null) {
            $result['accepted_prediction_tokens'] = $this->acceptedPredictionTokens;
        }

        if ($this->rejectedPredictionTokens !== null) {
            $result['rejected_prediction_tokens'] = $this->rejectedPredictionTokens;
        }

        return $result;
    }
}
