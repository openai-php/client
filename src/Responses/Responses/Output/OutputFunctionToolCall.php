<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputFunctionToolCallCallerType from OutputFunctionToolCallCaller
 *
 * @phpstan-type OutputFunctionToolCallType array{arguments: string, call_id: string, name: string, namespace?: ?string, type: 'function_call', id: string, status?: 'in_progress'|'completed'|'incomplete', caller?: OutputFunctionToolCallCallerType|null}
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
     * @param  'in_progress'|'completed'|'incomplete'|null  $status
     */
    private function __construct(
        public readonly string $arguments,
        public readonly string $callId,
        public readonly string $name,
        public readonly string $type,
        public readonly string $id,
        public readonly ?string $status,
        public readonly ?string $namespace,
        public readonly ?OutputFunctionToolCallCaller $caller,
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
            status: $attributes['status'] ?? null,
            namespace: $attributes['namespace'] ?? null,
            caller: isset($attributes['caller'])
                ? OutputFunctionToolCallCaller::from($attributes['caller'])
                : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'arguments' => $this->arguments,
            'call_id' => $this->callId,
            'name' => $this->name,
            'namespace' => $this->namespace,
            'type' => $this->type,
            'id' => $this->id,
            'status' => $this->status,
            'caller' => $this->caller?->toArray(),
        ], fn (mixed $value): bool => $value !== null);
    }
}
