<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseMessage
{
    private function __construct(
        public readonly string $role,
        public readonly ?string $content,
        public readonly ?CreateResponseFunctionCall $functionCall,
    ) {
    }

    /**
     * @param  array{role: string, content: ?string, function_call: ?array{name: string, arguments: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['role'],
            $attributes['content'],
            isset($attributes['function_call']) ? CreateResponseFunctionCall::from($attributes['function_call']) : null,
        );
    }

    /**
     * @return array{role: string, content: string|null, function_call?: array{name: string, arguments: string}}
     */
    public function toArray(): array
    {
        $data = [
            'role' => $this->role,
            'content' => $this->content,
        ];

        if ($this->functionCall instanceof CreateResponseFunctionCall) {
            $data['function_call'] = $this->functionCall->toArray();
        }

        return $data;
    }
}
