<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
 */
final class ThreadRunResponseRequiredActionSubmitToolOutputs implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, RequiredActionFunctionToolCall>  $toolCalls
     */
    private function __construct(
        public array $toolCalls,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}|string  $attributes
     */
    public static function from(array|string $attributes): self
    {
        $toolCalls = array_map(fn (array $toolCall): \OpenAI\Responses\Threads\Runs\ThreadRunResponseRequiredActionFunctionToolCall => ThreadRunResponseRequiredActionFunctionToolCall::from($toolCall), $attributes['tool_calls']);

        return new self(
            $toolCalls,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'tool_calls' => array_map(fn (ThreadRunResponseRequiredActionFunctionToolCall $toolCall): array => $toolCall->toArray(), $this->toolCalls),
        ];
    }
}
