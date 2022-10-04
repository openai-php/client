<?php

declare(strict_types=1);

namespace OpenAI\Responses\Completions;

final class CreateResponseChoice
{
    private function __construct(
        public readonly string $text,
        public readonly int $index,
        public readonly ?int $logprobs,
        public readonly string $finishReason,
    ) {
    }

    /**
     * @param  array{text: string, index: int, logprobs: int|null, finish_reason: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['text'],
            $attributes['index'],
            $attributes['logprobs'],
            $attributes['finish_reason'],
        );
    }

    /**
     * @return array{text: string, index: int, logprobs: int|null, finish_reason: string}
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'index' => $this->index,
            'logprobs' => $this->logprobs,
            'finish_reason' => $this->finishReason,
        ];
    }
}
