<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
 */
final class ThreadRunResponseRequiredAction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, TranscriptionResponseSegment>  $segments
     */
    private function __construct(
        public string $type,
        public ThreadRunResponseRequiredActionSubmitToolOutputs $submitToolOutputs,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}|string  $attributes
     */
    public static function from(array|string $attributes): self
    {
        return new self(
            $attributes['type'],
            ThreadRunResponseRequiredActionSubmitToolOutputs::from($attributes['submit_tool_outputs']),

        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'submit_tool_outputs' => $this->submitToolOutputs->toArray(),
        ];
    }
}
