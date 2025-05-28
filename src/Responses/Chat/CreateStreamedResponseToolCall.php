<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateStreamedResponseToolCall
{
    private function __construct(
        public readonly ?int $index,
        public readonly ?string $id,
        public readonly ?string $type,
        public readonly CreateStreamedResponseToolCallFunction $function,
    ) {}

    /**
     * @param  array{index?: int, id?: string, type?: string, function: array{name?: string, arguments: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['index'] ?? null,
            $attributes['id'] ?? null,
            $attributes['type'] ?? null,
            CreateStreamedResponseToolCallFunction::from($attributes['function']),
        );
    }

    /**
     * @return array{index?: int, id?: string, type?: string, function?: array{name?: string, arguments: string}}
     */
    public function toArray(): array
    {
        return array_filter([
            'index' => $this->index,
            'id' => $this->id,
            'type' => $this->type,
            'function' => $this->function->toArray(),
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
