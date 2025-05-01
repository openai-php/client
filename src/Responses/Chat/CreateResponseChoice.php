<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseChoice
{
    private function __construct(
        public readonly int $index,
        public readonly CreateResponseMessage $message,
        public readonly ?CreateResponseChoiceLogprobs $logprobs,
        public readonly ?string $finishReason,
    ) {}

    /**
     * @param  array{index: int, message: array{role: string, content: ?string, annotations?: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call: ?array{name: string, arguments: string}, tool_calls: ?array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>} ,logprobs?: ?array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}, finish_reason: string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['index'],
            CreateResponseMessage::from($attributes['message']),
            isset($attributes['logprobs']) ? CreateResponseChoiceLogprobs::from($attributes['logprobs']) : null,
            $attributes['finish_reason'] ?? null,
        );
    }

    /**
     * @return array{index: int, message: array{role: string, content: string|null, annotations?: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call?: array{name: string, arguments: string}, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}, logprobs: ?array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}, finish_reason: string|null}
     */
    public function toArray(): array
    {
        return [
            'index' => $this->index,
            'message' => $this->message->toArray(),
            'logprobs' => $this->logprobs?->toArray(),
            'finish_reason' => $this->finishReason,
        ];
    }
}
