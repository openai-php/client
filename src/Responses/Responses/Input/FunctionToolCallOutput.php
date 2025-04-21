<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{call_id: string, id: string, output: string, type: 'function_call_output', status: 'in_progress'|'completed'|'incompleted'}>
 */
final class FunctionToolCallOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{call_id: string, id: string, output: string, type: 'function_call_output', status: 'in_progress'|'completed'|'incompleted'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'function_call_output'  $type
     */
    private function __construct(
        public readonly string $callId,
        public readonly string $id,
        public readonly string $output,
        public readonly string $type,
        public readonly string $status,
    ) {}

    /**
     * @param  array{call_id: string, id: string, output: string, type: 'function_call_output', status: 'in_progress'|'completed'|'incompleted'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            callId: $attributes['call_id'],
            id: $attributes['id'],
            output: $attributes['output'],
            type: $attributes['type'],
            status: $attributes['status'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'call_id' => $this->callId,
            'id' => $this->id,
            'output' => $this->output,
            'type' => $this->type,
            'status' => $this->status,
        ];
    }
}
