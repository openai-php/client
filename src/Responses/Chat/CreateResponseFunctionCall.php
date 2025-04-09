<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

/**
 * @deprecated
 */
final class CreateResponseFunctionCall
{
    private function __construct(
        public readonly string $name,
        public readonly string $arguments,
    ) {}

    /**
     * @param  array{name: string, arguments: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
            $attributes['arguments'],
        );
    }

    /**
     * @return array{name: string, arguments: string}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'arguments' => $this->arguments,
        ];
    }
}
