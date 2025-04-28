<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseMessage
{
    /**
     * @param  array<int, CreateResponseToolCall>  $toolCalls
     */
    private function __construct(
        public readonly string $role,
        public readonly ?string $content,
        public readonly ?array $annotations,
        public readonly array $toolCalls,
        public readonly ?CreateResponseFunctionCall $functionCall,
    ) {}

    /**
     * @param  array{role: string, content: ?string, annotations?: ?array<int, array{type: "url_citation", url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call: ?array{name: string, arguments: string}, tool_calls: ?array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $toolCalls = array_map(fn (array $result): CreateResponseToolCall => CreateResponseToolCall::from(
            $result
        ), $attributes['tool_calls'] ?? []);

        $annotations = isset($attributes['annotations']) ? array_map(
            fn (array $result): CreateResponseChoiceAnnotations => CreateResponseChoiceAnnotations::from($result),
            $attributes['annotations']
        ) : null;

        dump($annotations); // Test  is showing me that there is an extra array wrapped around the annotations.

        return new self(
            $attributes['role'],
            $attributes['content'] ?? null,
            $annotations,
            $toolCalls,
            isset($attributes['function_call']) ? CreateResponseFunctionCall::from($attributes['function_call']) : null,
        );
    }

    /**
     * @return array{role: string, content: string|null, function_call?: array{name: string, arguments: string},annotations?: ?array<int, array{type: "url_citation", url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}
     */
    public function toArray(): array
    {
        $data = [
            'role' => $this->role,
            'content' => $this->content,
        ];

        if ($this->annotations) {
            $data['annotations'] = $this->annotations;
        }

        if ($this->functionCall instanceof CreateResponseFunctionCall) {
            $data['function_call'] = $this->functionCall->toArray();
        }

        if ($this->toolCalls !== []) {
            $data['tool_calls'] = array_map(fn (CreateResponseToolCall $toolCall): array => $toolCall->toArray(), $this->toolCalls);
        }

        return $data;
    }
}
