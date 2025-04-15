<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

final class OutputMessage
{
    /**
     * @param  array<int, OutputMessage>  $outputs
     */
    private function __construct(
        public readonly array $outputs,
    ) {}

    /**
     * @param  array{reasoning_tokens: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['reasoning_tokens'],
        );
    }

    /**
     * @return array{reasoning_tokens: int}
     */
    public function toArray(): array
    {
        return array_map(
            fn (OutputMessage $output): array => $output->toArray(),
            $this->outputs,
        );
    }
}
