<?php

declare(strict_types=1);

namespace OpenAI\Responses\Completions;

final class CreateResponseChoice
{
    private function __construct(
        public readonly string $text,
        public readonly int $index,
        public readonly ?CreateResponseChoiceLogprobs $logprobs,
        public readonly ?string $finishReason,
    ) {
    }

    /**
    @param  array{text?: string, delta?: array{content: string}, index: int, logprobs?: array{tokens: array<int, string>, token_logprobs: array<int, float>, top_logprobs: array<int, string>|null, text_offset: array<int, int>}|null, finish_reason?: string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            text: $attributes['text'] ?? $attributes['delta']['content'] ?? '',
            index: $attributes['index'],
            logprobs: $attributes['logprobs'] ? CreateResponseChoiceLogprobs::from($attributes['logprobs']) : null,
            finishReason: $attributes['finish_reason'],
        );
    }

    /**
     * @return array{text: string, index: int, logprobs: array{tokens: array<int, string>, token_logprobs: array<int, float>, top_logprobs: array<int, string>|null, text_offset: array<int, int>}|null, finish_reason: string|null}
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'index' => $this->index,
            'logprobs' => $this->logprobs instanceof CreateResponseChoiceLogprobs ? $this->logprobs->toArray() : null,
            'finish_reason' => $this->finishReason,
        ];
    }
}
