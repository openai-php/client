<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}>, words: array<int, array{word: string, start: float, end: float}>, text: string}>
 */
final class TranscriptionResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}>, words: array<int, array{word: string, start: float, end: float}>, text: string}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, TranscriptionResponseSegment>  $segments
     * @param  array<int, TranscriptionResponseWord>  $words
     */
    private function __construct(
        public readonly ?string $task,
        public readonly ?string $language,
        public readonly ?float $duration,
        public readonly array $segments,
        public readonly array $words,
        public readonly string $text,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}>, words: array<int, array{word: string, start: float, end: float}>, text: string}|string  $attributes
     */
    public static function from(array|string $attributes, MetaInformation $meta): self
    {
        if (is_string($attributes)) {
            $attributes = ['text' => $attributes];
        }

        $segments = isset($attributes['segments']) ? array_map(fn (array $result): TranscriptionResponseSegment => TranscriptionResponseSegment::from(
            $result
        ), $attributes['segments']) : [];

        $words = isset($attributes['words']) ? array_map(fn (array $result): TranscriptionResponseWord => TranscriptionResponseWord::from(
            $result
        ), $attributes['words']) : [];

        return new self(
            $attributes['task'] ?? null,
            $attributes['language'] ?? null,
            $attributes['duration'] ?? null,
            $segments,
            $words,
            $attributes['text'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'task' => $this->task,
            'language' => $this->language,
            'duration' => $this->duration,
            'segments' => array_map(
                static fn (TranscriptionResponseSegment $result): array => $result->toArray(),
                $this->segments,
            ),
            'words' => array_map(
                static fn (TranscriptionResponseWord $result): array => $result->toArray(),
                $this->words,
            ),
            'text' => $this->text,
        ];
    }
}
