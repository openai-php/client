<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{word: string, start: float, end: float}>
 */
final class TranscriptionResponseWord implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{word: string, start: float, end: float}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $word,
        public readonly float $start,
        public readonly float $end,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{word: string, start: float, end: float}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['word'],
            $attributes['start'],
            $attributes['end'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'word' => $this->word,
            'start' => $this->start,
            'end' => $this->end,
        ];
    }
}
