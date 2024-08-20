<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateStreamedResponseToolCallFunction
{
    private function __construct(
        public readonly ?string $name,
        public readonly string $arguments,
    ) {}

    /**
     * @param  array{name?: string, arguments: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'] ?? null,
            $attributes['arguments'],
        );
    }

    /**
     * @return array{name?: string, arguments: string}
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'arguments' => $this->arguments,
        ], fn (?string $value): bool => ! is_null($value));
    }
}
