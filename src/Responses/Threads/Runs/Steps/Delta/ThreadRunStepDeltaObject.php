<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps\Delta;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseMessageCreationStepDetails;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseToolCallsStepDetails;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}}>
 */
final class ThreadRunStepDeltaObject implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public ThreadRunStepResponseMessageCreationStepDetails|ThreadRunStepResponseToolCallsStepDetails $stepDetails,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{step_details: array{type: 'tool_calls', tool_calls: array<int, array{id?: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id?: string, type: 'function', function: array{name?: string, arguments: string, output?: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $stepDetails = match ($attributes['step_details']['type']) {
            'message_creation' => ThreadRunStepResponseMessageCreationStepDetails::from($attributes['step_details']),
            'tool_calls' => ThreadRunStepResponseToolCallsStepDetails::from($attributes['step_details']),
        };

        return new self(
            $stepDetails,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'step_details' => $this->stepDetails->toArray(),
        ];
    }
}
