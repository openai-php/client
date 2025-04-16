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
     * @param  array{audio_tokens?:int|null, reasoning_tokens?:int|null, accepted_prediction_tokens?:int|null, rejected_prediction_tokens?:int|null}  $attributes
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

        if (! is_null($this->reasoningTokens)) {
            $result['reasoning_tokens'] = $this->reasoningTokens;
        }

        if (! is_null($this->acceptedPredictionTokens)) {
            $result['accepted_prediction_tokens'] = $this->acceptedPredictionTokens;
        }

        if (! is_null($this->rejectedPredictionTokens)) {
            $result['rejected_prediction_tokens'] = $this->rejectedPredictionTokens;
        }

        if (! is_null($this->audioTokens)) {
            $result['audio_tokens'] = $this->audioTokens;
        }

        return $result;
    }
}
