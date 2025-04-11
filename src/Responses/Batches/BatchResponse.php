<?php

declare(strict_types=1);

namespace OpenAI\Responses\Batches;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, endpoint: string, errors: ?array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts: ?array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}>
 */
final class BatchResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, endpoint: string, errors: ?array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts: ?array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<string, string>|null  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public string $endpoint,
        public ?BatchResponseErrors $errors,
        public string $inputFileId,
        public string $completionWindow,
        public string $status,
        public ?string $outputFileId,
        public ?string $errorFileId,
        public int $createdAt,
        public ?int $inProgressAt,
        public ?int $expiresAt,
        public ?int $finalizingAt,
        public ?int $completedAt,
        public ?int $failedAt,
        public ?int $expiredAt,
        public ?int $cancellingAt,
        public ?int $cancelledAt,
        public ?BatchResponseRequestCounts $requestCounts,
        public ?array $metadata,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, endpoint: string, errors?: array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts?: array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['endpoint'],
            isset($attributes['errors']) ? BatchResponseErrors::from($attributes['errors']) : null,
            $attributes['input_file_id'],
            $attributes['completion_window'],
            $attributes['status'],
            $attributes['output_file_id'],
            $attributes['error_file_id'],
            $attributes['created_at'],
            $attributes['in_progress_at'],
            $attributes['expires_at'],
            $attributes['finalizing_at'],
            $attributes['completed_at'],
            $attributes['failed_at'],
            $attributes['expired_at'],
            $attributes['cancelling_at'],
            $attributes['cancelled_at'],
            isset($attributes['request_counts']) ? BatchResponseRequestCounts::from($attributes['request_counts']) : null,
            $attributes['metadata'],
            $meta
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
            'endpoint' => $this->endpoint,
            'errors' => $this->errors?->toArray(),
            'input_file_id' => $this->inputFileId,
            'completion_window' => $this->completionWindow,
            'status' => $this->status,
            'output_file_id' => $this->outputFileId,
            'error_file_id' => $this->errorFileId,
            'created_at' => $this->createdAt,
            'in_progress_at' => $this->inProgressAt,
            'expires_at' => $this->expiresAt,
            'finalizing_at' => $this->finalizingAt,
            'completed_at' => $this->completedAt,
            'failed_at' => $this->failedAt,
            'expired_at' => $this->expiredAt,
            'cancelling_at' => $this->cancellingAt,
            'cancelled_at' => $this->cancelledAt,
            'request_counts' => $this->requestCounts?->toArray(),
            'metadata' => $this->metadata,
        ];
    }
}
