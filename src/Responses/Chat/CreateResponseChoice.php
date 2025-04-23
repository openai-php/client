<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseChoice
{
    private function __construct(
        public readonly int $index,
        public readonly CreateResponseMessage $message,
        public readonly ?CreateResponseChoiceWebSearchOptions $webSearchOptions,
        public readonly ?CreateResponseChoiceLogprobs $logprobs,
        public readonly ?string $finishReason,
    ) {}

    /**
     * @param  array{index: int, message: array{role: string, content: ?string, function_call: ?array{name: string, arguments: string}, tool_calls: ?array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}, web_search_options?: ?array{content?: ?array<int, array{token: string, logprob: float, bytes?: ?array<int, int>}>},logprobs?: ?array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}, finish_reason: string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['index'],
            CreateResponseMessage::from($attributes['message']),
            isset($attributes['web_search_options']) ? CreateResponseChoiceWebSearchOptions::from($attributes['web_search_options']) : null,
            isset($attributes['logprobs']) ? CreateResponseChoiceLogprobs::from($attributes['logprobs']) : null,
            $attributes['finish_reason'] ?? null,
        );
    }

    /**
     * @return array{index: int, message: array{role: string, content: string|null, function_call?: array{name: string, arguments: string}, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>},web_search_options?: ?array{content?: ?array<int, array{token: string, logprob: float, bytes?: ?array<int, int>}>}, logprobs: ?array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}, finish_reason: string|null}
     */
    public function toArray(): array
    {
        return [
            'index' => $this->index,
            'message' => $this->message->toArray(),
            'web_search_options' => $this->webSearchOptions->toArray(),
            'logprobs' => $this->logprobs?->toArray(),
            'finish_reason' => $this->finishReason,
        ];
    }
}
