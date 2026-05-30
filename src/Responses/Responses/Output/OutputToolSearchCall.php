<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputToolSearchCallType array{id: string, arguments: mixed, call_id: ?string, execution: 'server'|'client', status: 'in_progress'|'completed'|'incomplete', type: 'tool_search_call', created_by?: ?string}
 *
 * @implements ResponseContract<OutputToolSearchCallType>
 */
final class OutputToolSearchCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputToolSearchCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'server'|'client'  $execution
     * @param  'in_progress'|'completed'|'incomplete'  $status
     * @param  'tool_search_call'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly mixed $arguments,
        public readonly ?string $callId,
        public readonly string $execution,
        public readonly string $status,
        public readonly string $type,
        public readonly ?string $createdBy,
    ) {}

    /**
     * @param  OutputToolSearchCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            arguments: $attributes['arguments'],
            callId: $attributes['call_id'] ?? null,
            execution: $attributes['execution'],
            status: $attributes['status'],
            type: $attributes['type'],
            createdBy: $attributes['created_by'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'arguments' => $this->arguments,
            'call_id' => $this->callId,
            'execution' => $this->execution,
            'status' => $this->status,
            'type' => $this->type,
            'createdBy' => $this->createdBy,
        ];
    }
}
