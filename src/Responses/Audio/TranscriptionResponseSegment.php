<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: int|string, start: float, end: float, text: string, seek?: int, tokens?: array<int, int>, temperature?: float, avg_logprob?: float, compression_ratio?: float, no_speech_prob?: float, transient?: bool, speaker?: string, type?: string}>
 */
final class TranscriptionResponseSegment implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: int|string, start: float, end: float, text: string, seek?: int, tokens?: array<int, int>, temperature?: float, avg_logprob?: float, compression_ratio?: float, no_speech_prob?: float, transient?: bool, speaker?: string, type?: string}>
     */
    use ArrayAccessible;

    /**
     * @param  int|string  $id  string in case of diarization, int otherwise
     * @param  array<int, int>  $tokens
     */
    private function __construct(
        public readonly int|string $id,
        public readonly float $start,
        public readonly float $end,
        public readonly string $text,
        public readonly ?int $seek,
        public readonly ?array $tokens,
        public readonly ?float $temperature,
        public readonly ?float $avgLogprob,
        public readonly ?float $compressionRatio,
        public readonly ?float $noSpeechProb,
        public readonly ?bool $transient,
        public readonly ?string $speaker,
        public readonly ?string $type,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: int|string, start: float, end: float, text: string, seek?: int, tokens?: array<int, int>, temperature?: float, avg_logprob?: float, compression_ratio?: float, no_speech_prob?: float, transient?: bool, speaker?: string, type?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['start'],
            $attributes['end'],
            $attributes['text'],
            $attributes['seek'] ?? null,
            $attributes['tokens'] ?? null,
            $attributes['temperature'] ?? null,
            $attributes['avg_logprob'] ?? null,
            $attributes['compression_ratio'] ?? null,
            $attributes['no_speech_prob'] ?? null,
            $attributes['transient'] ?? null,
            $attributes['speaker'] ?? null,
            $attributes['type'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'text' => $this->text,
        ];

        if ($this->seek !== null) {
            $data['seek'] = $this->seek;
        }

        if ($this->tokens !== null) {
            $data['tokens'] = $this->tokens;
        }

        if ($this->temperature !== null) {
            $data['temperature'] = $this->temperature;
        }

        if ($this->avgLogprob !== null) {
            $data['avg_logprob'] = $this->avgLogprob;
        }

        if ($this->compressionRatio !== null) {
            $data['compression_ratio'] = $this->compressionRatio;
        }

        if ($this->noSpeechProb !== null) {
            $data['no_speech_prob'] = $this->noSpeechProb;
        }

        if ($this->transient !== null) {
            $data['transient'] = $this->transient;
        }

        if ($this->speaker !== null) {
            $data['speaker'] = $this->speaker;
        }

        if ($this->type !== null) {
            $data['type'] = $this->type;
        }

        return $data;
    }
}
