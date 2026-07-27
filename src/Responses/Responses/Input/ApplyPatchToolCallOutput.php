<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ApplyPatchToolCallOutputCallerType array{type: 'direct'}|array{caller_id: string, type: 'program'}
 * @phpstan-type ApplyPatchToolCallOutputType array{id: string, call_id: string, status: 'completed'|'failed', type: 'apply_patch_call_output', caller?: ApplyPatchToolCallOutputCallerType|null, created_by?: ?string, output?: ?string}
 *
 * @implements ResponseContract<ApplyPatchToolCallOutputType>
 */
final class ApplyPatchToolCallOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<ApplyPatchToolCallOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'completed'|'failed'  $status
     * @param  'apply_patch_call_output'  $type
     * @param  ApplyPatchToolCallOutputCallerType|null  $caller
     */
    private function __construct(
        public readonly string $id,
        public readonly string $callId,
        public readonly string $status,
        public readonly string $type,
        public readonly ?array $caller,
        public readonly ?string $createdBy,
        public readonly ?string $output,
    ) {}

    /**
     * @param  ApplyPatchToolCallOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            callId: $attributes['call_id'],
            status: $attributes['status'],
            type: $attributes['type'],
            caller: $attributes['caller'] ?? null,
            createdBy: $attributes['created_by'] ?? null,
            output: $attributes['output'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'call_id' => $this->callId,
            'status' => $this->status,
            'type' => $this->type,
            'caller' => $this->caller,
            'created_by' => $this->createdBy,
            'output' => $this->output,
        ];
    }
}
