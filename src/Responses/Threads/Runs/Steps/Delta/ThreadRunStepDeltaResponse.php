<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps\Delta;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: ?string, object: string, delta: array{step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}}}>
 */
final class ThreadRunStepDeltaResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: ?string, object: string, delta: array{step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public ?string $id,
        public string $object,
        public ThreadRunStepDeltaObject $delta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id?: string, object: string, delta: array{step_details: array{type: 'tool_calls', tool_calls: array<int, array{id?: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id?: string, type: 'function', function: array{name?: string, arguments: string, output?: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['object'],
            ThreadRunStepDeltaObject::from($attributes['delta']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'delta' => $this->delta->toArray(),
        ];
    }
}
