<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseToolCall
{
    /**
     * @param  array<string, array<string,string>>|null  $extraContent
     */
    private function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly ?CreateResponseToolCallFunction $function,
        public readonly ?array $extraContent = null,
        public readonly ?CreateResponseToolCallCustom $custom = null,
    ) {}

    /**
     * @param  array{id: string, type?: string, function?: array{name: string, arguments: string}, custom?: array{name: string, input: string}, extra_content?: array<string, array<string,string>>|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'] ?? 'function',
            isset($attributes['function']) ? CreateResponseToolCallFunction::from($attributes['function']) : null,
            $attributes['extra_content'] ?? null,
            isset($attributes['custom']) ? CreateResponseToolCallCustom::from($attributes['custom']) : null,
        );
    }

    /**
     * @return array{id: string, type: string, function?: array{name: string, arguments: string}, custom?: array{name: string, input: string}, extra_content?: array<string, array<string,string>>}
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'function' => $this->function?->toArray(),
            'custom' => $this->custom?->toArray(),
            'extra_content' => $this->extraContent,
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
