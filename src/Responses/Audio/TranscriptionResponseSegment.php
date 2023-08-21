<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>
 */
final class TranscriptionResponseSegment implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, int>  $tokens
     */
    private function __construct(
        public readonly int $id,
        public readonly int $seek,
        public readonly float $start,
        public readonly float $end,
        public readonly string $text,
        public readonly array $tokens,
        public readonly float $temperature,
        public readonly float $avgLogprob,
        public readonly float $compressionRatio,
        public readonly float $noSpeechProb,
        public readonly bool $transient,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['seek'],
            $attributes['start'],
            $attributes['end'],
            $attributes['text'],
            $attributes['tokens'],
            $attributes['temperature'],
            $attributes['avg_logprob'],
            $attributes['compression_ratio'],
            $attributes['no_speech_prob'],
            $attributes['transient'] ?? false,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'seek' => $this->seek,
            'start' => $this->start,
            'end' => $this->end,
            'text' => $this->text,
            'tokens' => $this->tokens,
            'temperature' => $this->temperature,
            'avg_logprob' => $this->avgLogprob,
            'compression_ratio' => $this->compressionRatio,
            'no_speech_prob' => $this->noSpeechProb,
            'transient' => $this->transient,
        ];
    }
}
