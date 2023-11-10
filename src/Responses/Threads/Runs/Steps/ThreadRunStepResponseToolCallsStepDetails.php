<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
 */
final class ThreadRunStepResponseToolCallsStepDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, ThreadRunStepResponseCodeToolCall|ThreadRunStepResponseRetrievalToolCall|ThreadRunStepResponseFunctionToolCall>  $tools
     */
    private function __construct(
        public string $type,
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
        $toolCalls = array_map(
            fn (array $toolCall): ThreadRunStepResponseCodeToolCall|ThreadRunStepResponseRetrievalToolCall|ThreadRunStepResponseFunctionToolCall => match ($toolCall['type']) {
                'code_interpreter' => ThreadRunStepResponseCodeToolCall::from($toolCall),
                'retrieval' => ThreadRunStepResponseRetrievalToolCall::from($toolCall),
                'function' => ThreadRunStepResponseFunctionToolCall::from($toolCall),
            },
            $attributes['tool_calls'],
        );

        return new self(
            $attributes['type'],
            $toolCalls,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'tool_calls' => array_map(
                fn (ThreadRunStepResponseCodeToolCall|ThreadRunStepResponseRetrievalToolCall|ThreadRunStepResponseFunctionToolCall $toolCall): array => $toolCall->toArray(),
                $this->toolCalls,
            ),
        ];
    }
}
