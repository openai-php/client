<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateStreamedResponseDelta
{
    /**
     * @param  array<int, CreateStreamedResponseToolCall>  $toolCalls
     */
    private function __construct(
        public readonly ?string $role,
        public readonly ?string $content,
        public readonly array $toolCalls,
        public readonly ?CreateStreamedResponseFunctionCall $functionCall,
    ) {}

    /**
     * @param  array{role?: string, content?: string, function_call?: array{name?: ?string, arguments?: ?string}, tool_calls?: array<int, array{id?: string, type?: string, function: array{name?: string, arguments: string}}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $toolCalls = array_map(fn (array $result): CreateStreamedResponseToolCall => CreateStreamedResponseToolCall::from(
            $result
        ), $attributes['tool_calls'] ?? []);

        return new self(
            $attributes['role'] ?? null,
            $attributes['content'] ?? null,
            $toolCalls,
            isset($attributes['function_call']) ? CreateStreamedResponseFunctionCall::from($attributes['function_call']) : null,
        );
    }

    /**
     * @return array{role?: string, content?: string}|array{role?: string, content: null, function_call: array{name?: string, arguments?: string}}
     */
    public function toArray(): array
    {
        $data = array_filter([
            'role' => $this->role,
            'content' => $this->content,
        ], fn (?string $value): bool => ! is_null($value));

        if ($this->functionCall instanceof CreateStreamedResponseFunctionCall) {
            $data['content'] = null;
            $data['function_call'] = $this->functionCall->toArray();
        }

        if ($this->toolCalls !== []) {
            $data['tool_calls'] = array_map(fn (CreateStreamedResponseToolCall $toolCall): array => $toolCall->toArray(), $this->toolCalls);
        }

        return $data;
    }
}
