<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseToolCall
{
    private function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly CreateResponseToolCallFunction $function,
        public readonly ?CreateResponseToolCallExtraContent $extra_content,
    ) {}

    /**
     * @param  array{id: string, type?: string, function: array{name: string, arguments: string}, extra_content?: array{google?: array{thought_signature: string}}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'] ?? 'function',
            CreateResponseToolCallFunction::from($attributes['function']),
            isset($attributes['extra_content']) ? CreateResponseToolCallExtraContent::from($attributes['extra_content']) : null,
        );
    }

    /**
     * @return array{id: string, type: string, function: array{name: string, arguments: string}, extra_content?: array{google?: array{thought_signature: string}|null}}
     */
    public function toArray(): array
    {
        $extraContentArray = $this->extra_content?->toArray();

        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'function' => $this->function->toArray(),
            'extra_content' => empty($extraContentArray) ? null : $extraContentArray,
        ], fn ($value) => $value !== null);
    }
}
