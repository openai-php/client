<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseUsage
{
    private function __construct(
        public readonly int $promptTokens,
        public readonly ?int $completionTokens,
        public readonly int $totalTokens,
        public readonly ?CreateResponseUsagePromptTokensDetails $promptTokensDetails,
        public readonly ?CreateResponseUsageCompletionTokensDetails $completionTokensDetails,
        public readonly ?string $searchContextSize,
    ) {}

    /**
     * @param  array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int, prompt_tokens_details?:array{cached_tokens:int}, completion_tokens_details?:array{audio_tokens?:int, reasoning_tokens:int, accepted_prediction_tokens:int, rejected_prediction_tokens:int}, search_context_size: string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['prompt_tokens'],
            $attributes['completion_tokens'] ?? null,
            $attributes['total_tokens'],
            isset($attributes['prompt_tokens_details']) ? CreateResponseUsagePromptTokensDetails::from($attributes['prompt_tokens_details']) : null,
            isset($attributes['completion_tokens_details']) ? CreateResponseUsageCompletionTokensDetails::from($attributes['completion_tokens_details']) : null,
            $attributes['search_context_size'] ?? null,
        );
    }

    /**
     * @return array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int, prompt_tokens_details?:array{cached_tokens:int}, search_context_size: string|null}
     */
    public function toArray(): array
    {
        $result = [
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'total_tokens' => $this->totalTokens,
        ];

        if ($this->promptTokensDetails) {
            $result['prompt_tokens_details'] = $this->promptTokensDetails->toArray();
        }

        if ($this->completionTokensDetails) {
            $result['completion_tokens_details'] = $this->completionTokensDetails->toArray();
        }

        if ($this->searchContextSize) {
            $result['search_context_size'] = $this->searchContextSize;
        }

        return $result;
    }
}
