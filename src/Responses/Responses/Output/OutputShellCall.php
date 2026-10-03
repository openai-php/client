<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Tool\ShellContainerReference;
use OpenAI\Responses\Responses\Tool\ShellLocalEnvironment;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputFunctionToolCallCallerType from OutputFunctionToolCallCaller
 * @phpstan-import-type OutputShellCallActionType from OutputShellCallAction
 * @phpstan-import-type ShellLocalEnvironmentType from ShellLocalEnvironment
 * @phpstan-import-type ShellContainerReferenceType from ShellContainerReference
 *
 * @phpstan-type OutputShellCallType array{type: 'shell_call', id?: string|null, status?: 'in_progress'|'completed'|'incomplete'|null, call_id: string, caller?: OutputFunctionToolCallCallerType|null, created_by?: string, action: OutputShellCallActionType, environment?: ShellLocalEnvironmentType|ShellContainerReferenceType|null}
 *
 * @implements ResponseContract<OutputShellCallType>
 */
final class OutputShellCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputShellCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'shell_call'  $type
     * @param  'in_progress'|'completed'|'incomplete'|null  $status
     */
    private function __construct(
        public readonly ?string $id,
        public readonly string $type,
        public readonly ?string $status,
        public readonly string $callId,
        public readonly OutputShellCallAction $action,
        public readonly ShellLocalEnvironment|ShellContainerReference|null $environment,
        public readonly ?OutputFunctionToolCallCaller $caller,
        public readonly ?string $createdBy,
    ) {}

    /**
     * @param  OutputShellCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'] ?? null,
            type: $attributes['type'],
            status: $attributes['status'] ?? null,
            callId: $attributes['call_id'],
            action: OutputShellCallAction::from($attributes['action']),
            environment: isset($attributes['environment']) ? match ($attributes['environment']['type']) {
                'local' => ShellLocalEnvironment::from($attributes['environment']),
                'container_reference' => ShellContainerReference::from($attributes['environment']),
            } : null,
            caller: isset($attributes['caller']) ? OutputFunctionToolCallCaller::from($attributes['caller']) : null,
            createdBy: $attributes['created_by'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'status' => $this->status,
            'call_id' => $this->callId,
            'action' => $this->action->toArray(),
            'environment' => $this->environment?->toArray(),
            'caller' => $this->caller?->toArray(),
            'created_by' => $this->createdBy,
        ], fn (mixed $value): bool => $value !== null);
    }
}
