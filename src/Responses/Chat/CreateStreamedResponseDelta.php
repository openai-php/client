<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateStreamedResponseDelta
{
    private function __construct(
        public readonly ?string $role,
        public readonly ?string $content,
        public readonly ?CreateStreamedResponseFunctionCall $functionCall,
    ) {
    }

    /**
     * @param  array{role?: string, content?: string, function_call?: array{name?: ?string, arguments?: ?string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['role'] ?? null,
            $attributes['content'] ?? null,
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
        ], fn (string|null $value): bool => ! is_null($value));

        if ($this->functionCall instanceof CreateStreamedResponseFunctionCall) {
            $data['content'] = null;
            $data['function_call'] = $this->functionCall->toArray();
        }

        return $data;
    }
}
