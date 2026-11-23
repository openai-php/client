<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseToolCallCustom
{
    private function __construct(
        public readonly string $name,
        public readonly string $input,
    ) {}

    /**
     * @param  array{name: string, input: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
            $attributes['input'],
        );
    }

    /**
     * @return array{name: string, input: string}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'input' => $this->input,
        ];
    }
}
