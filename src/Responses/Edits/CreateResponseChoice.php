<?php

declare(strict_types=1);

namespace OpenAI\Responses\Edits;

final class CreateResponseChoice
{
    private function __construct(
        public readonly string $text,
        public readonly int $index,
    ) {}

    /**
     * @param  array{text: string, index: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['text'],
            $attributes['index'],
        );
    }

    /**
     * @return array{text: string, index: int}
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'index' => $this->index,
        ];
    }
}
