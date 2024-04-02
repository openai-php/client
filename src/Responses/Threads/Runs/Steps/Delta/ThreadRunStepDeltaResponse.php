<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps\Delta;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseLastError;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: string, tool_calls: array<int, array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}|array{id: string, type: string, retrieval: array<string, string>}|array{id: string, type: string, function: array{name: string, arguments: string, output: ?string}}>}|array{type: string, message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}>
 */
final class ThreadRunStepDeltaResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: string, tool_calls: array<int, array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}|array{id: string, type: string, retrieval: array<string, string>}|array{id: string, type: string, function: array{name: string, arguments: string, output: ?string}}>}|array{type: string, message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public ThreadRunStepDeltaObject $delta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'retrieval', retrieval: array<string, string>}|array{id: string, type: 'function', function: array{name: string, arguments: string, output?: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            ThreadRunStepDeltaObject::from($attributes['delta']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'object' => $this->object,
            'delta' => $this->delta->toArray(),
        ];

        return $data;
    }
}
