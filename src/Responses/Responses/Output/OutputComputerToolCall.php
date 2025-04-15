<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

final class OutputComputerToolCall
{
    private function __construct(

    ) {}

    public static function from(array $attributes): self
    {
        return new self;
    }

    public function toArray(): array
    {
        return [

        ];
    }
}
