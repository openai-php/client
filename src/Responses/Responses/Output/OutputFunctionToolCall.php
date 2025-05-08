<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputFunctionToolCallType array{arguments: string, call_id: string, name: string, type: 'function_call', id: string, status: 'in_progress'|'completed'|'incomplete'}
 *
 * @implements ResponseContract<OutputFunctionToolCallType>
 */
final class OutputFunctionToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputFunctionToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'function_call'  $type
     * @param  'in_progress'|'completed'|'incomplete'  $status
     */
    private function __construct(
        public readonly string $arguments,
        public readonly string $callId,
        public readonly string $name,
        public readonly string $type,
        public readonly string $id,
        public readonly string $status,
    ) {}

    /**
     * @param  OutputFunctionToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            arguments: $attributes['arguments'],
            callId: $attributes['call_id'],
            name: $attributes['name'],
            type: $attributes['type'],
            id: $attributes['id'],
            status: $attributes['status'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'arguments' => $this->arguments,
            'call_id' => $this->callId,
            'name' => $this->name,
            'type' => $this->type,
            'id' => $this->id,
            'status' => $this->status,
        ];
    }
}
