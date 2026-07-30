<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\ApplyPatchOperation\OutputApplyPatchOperationCreateFile;
use OpenAI\Responses\Responses\Output\ApplyPatchOperation\OutputApplyPatchOperationDeleteFile;
use OpenAI\Responses\Responses\Output\ApplyPatchOperation\OutputApplyPatchOperationUpdateFile;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputApplyPatchOperationCreateFileType from OutputApplyPatchOperationCreateFile
 * @phpstan-import-type OutputApplyPatchOperationDeleteFileType from OutputApplyPatchOperationDeleteFile
 * @phpstan-import-type OutputApplyPatchOperationUpdateFileType from OutputApplyPatchOperationUpdateFile
 *
 * @phpstan-type OutputApplyPatchToolCallCallerType array{type: 'direct'}|array{caller_id: string, type: 'program'}
 * @phpstan-type OutputApplyPatchToolCallType array{id: string, call_id: string, operation: OutputApplyPatchOperationCreateFileType|OutputApplyPatchOperationDeleteFileType|OutputApplyPatchOperationUpdateFileType, status: 'in_progress'|'completed', type: 'apply_patch_call', caller?: OutputApplyPatchToolCallCallerType|null, created_by?: ?string}
 *
 * @implements ResponseContract<OutputApplyPatchToolCallType>
 */
final class OutputApplyPatchToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputApplyPatchToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'in_progress'|'completed'  $status
     * @param  'apply_patch_call'  $type
     * @param  OutputApplyPatchToolCallCallerType|null  $caller
     */
    private function __construct(
        public readonly string $id,
        public readonly string $callId,
        public readonly OutputApplyPatchOperationCreateFile|OutputApplyPatchOperationDeleteFile|OutputApplyPatchOperationUpdateFile $operation,
        public readonly string $status,
        public readonly string $type,
        public readonly ?array $caller,
        public readonly ?string $createdBy,
    ) {}

    /**
     * @param  OutputApplyPatchToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        $operation = match ($attributes['operation']['type']) {
            'create_file' => OutputApplyPatchOperationCreateFile::from($attributes['operation']),
            'delete_file' => OutputApplyPatchOperationDeleteFile::from($attributes['operation']),
            'update_file' => OutputApplyPatchOperationUpdateFile::from($attributes['operation']),
        };

        return new self(
            id: $attributes['id'],
            callId: $attributes['call_id'],
            operation: $operation,
            status: $attributes['status'],
            type: $attributes['type'],
            caller: $attributes['caller'] ?? null,
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
            'call_id' => $this->callId,
            'operation' => $this->operation->toArray(),
            'status' => $this->status,
            'type' => $this->type,
            'caller' => $this->caller,
            'created_by' => $this->createdBy,
        ];
    }
}
