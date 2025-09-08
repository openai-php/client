<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputLocalShellCallActionType from OutputLocalShellCallAction
 *
 * @phpstan-type OutputLocalShellCallType array{action: OutputLocalShellCallActionType, call_id: string, id: string, status: string, type: 'local_shell_call'}
 *
 * @implements ResponseContract<OutputLocalShellCallType>
 */
final class OutputLocalShellCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputLocalShellCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'local_shell_call'  $type
     */
    private function __construct(
        public readonly OutputLocalShellCallAction $action,
        public readonly string $callId,
        public readonly string $id,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputLocalShellCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            action: OutputLocalShellCallAction::from($attributes['action']),
            callId: $attributes['call_id'],
            id: $attributes['id'],
            status: $attributes['status'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'call_id' => $this->callId,
            'id' => $this->id,
            'action' => $this->action->toArray(),
            'status' => $this->status,
        ];
    }
}
