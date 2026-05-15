<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseToolCall
{
    private function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly CreateResponseToolCallFunction $function,
        public readonly ?array $extraContent,
    ) {}

    /**
     * @param  array{id: string, type?: string, function: array{name: string, arguments: string}, extra_content: array<string, array<string,string>>|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'] ?? 'function',
            CreateResponseToolCallFunction::from($attributes['function']),
            $attributes['extra_content'] ?? null,
        );
    }

    /**
     * @return array{id: string, type: string, function: array{name: string, arguments: string}, extra_content?: array<string, array<string,string>>}
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'function' => $this->function->toArray(),
            'extra_content' => $this->extraContent,
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
