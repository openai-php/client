<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseToolCall
{
    private function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly CreateResponseToolCallFunction $function,
    ) {
    }

    /**
     * @param  array{id: string, type: string, function: array{name: string, arguments: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'],
            CreateResponseToolCallFunction::from($attributes['function']),
        );
    }

    /**
     * @return array{id: string, type: string, function: array{name: string, arguments: string}}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'function' => $this->function->toArray(),
        ];
    }
}
