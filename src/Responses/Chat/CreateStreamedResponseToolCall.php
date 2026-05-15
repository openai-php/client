<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateStreamedResponseToolCall
{
    /**
     * @param array<string, array<string,string>>|null $extraContent
     */
    private function __construct(
        public readonly ?int $index,
        public readonly ?string $id,
        public readonly ?string $type,
        public readonly CreateStreamedResponseToolCallFunction $function,
        public readonly ?array $extraContent,
    ) {}

    /**
     * @param  array{index?: int, id?: string, type?: string, function: array{name?: string, arguments: string}, extra_content: array<string, array<string,string>>|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['index'] ?? null,
            $attributes['id'] ?? null,
            $attributes['type'] ?? null,
            CreateStreamedResponseToolCallFunction::from($attributes['function']),
            $attributes['extra_content'] ?? null,
        );
    }

    /**
     * @return array{index?: int, id?: string, type?: string, function?: array{name?: string, arguments: string}, extra_content?: array<string, array<string,string>>}
     */
    public function toArray(): array
    {
        return array_filter([
            'index' => $this->index,
            'id' => $this->id,
            'type' => $this->type,
            'function' => $this->function->toArray(),
            'extra_content' => $this->extraContent,
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
