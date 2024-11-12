<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseUsageCompletionTokensDetails
{
    private function __construct(
        public readonly ?int $audioTokens,
        public readonly int $reasoningTokens,
        public readonly int $acceptedPredictionTokens,
        public readonly int $rejectedPredictionTokens
    ) {}

    /**
     * @param  array{audio_tokens?:int, reasoning_tokens:int, accepted_prediction_tokens:int, rejected_prediction_tokens:int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['audio_tokens'] ?? null,
            $attributes['reasoning_tokens'],
            $attributes['accepted_prediction_tokens'],
            $attributes['rejected_prediction_tokens'],
        );
    }

    /**
     * @return array{audio_tokens?:int, reasoning_tokens:int, accepted_prediction_tokens:int, rejected_prediction_tokens:int}
     */
    public function toArray(): array
    {
        $result = [
            'reasoning_tokens' => $this->reasoningTokens,
            'accepted_prediction_tokens' => $this->acceptedPredictionTokens,
            'rejected_prediction_tokens' => $this->rejectedPredictionTokens,
        ];

        if (! is_null($this->audioTokens)) {
            $result['audio_tokens'] = $this->audioTokens;
        }

        return $result;
    }
}
