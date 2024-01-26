<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: string, tool_calls: array<int, array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}|array{id: string, type: string, retrieval: array<string, string>}|array{id: string, type: string, function: array{name: string, arguments: string, output: ?string}}>}>
 */
final class ThreadRunStepResponseToolCallsStepDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string, tool_calls: array<int, array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}|array{id: string, type: string, retrieval: array<string, string>}|array{id: string, type: string, function: array{name: string, arguments: string, output: ?string}}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, ThreadRunStepResponseCodeToolCall|ThreadRunStepResponseRetrievalToolCall|ThreadRunStepResponseFunctionToolCall>  $toolCalls
     */
    private function __construct(
        public string $type,
        public array $toolCalls,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: 'tool_calls', tool_calls: array<int, array{id: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'retrieval', retrieval: array<string, string>}|array{id: string, type: 'function', function: array{name: string, arguments: string, output?: ?string}}>}  $attributes
     */
    public static function from(array $attributes): self
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
