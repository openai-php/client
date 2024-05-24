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
 * @implements ResponseContract<array{object: string, data: array<int, array{id: string, object: string, endpoint: string, errors: ?array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts: ?array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}>
 */
final class BatchListResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{id: string, object: string, endpoint: string, errors: ?array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts: ?array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, BatchResponse>  $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly ?string $firstId,
        public readonly ?string $lastId,
        public readonly bool $hasMore,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, data: array<int, array{id: string, object: string, endpoint: string, errors?: array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}, input_file_id: string, completion_window: string, status: string, output_file_id: ?string, error_file_id: ?string, created_at: int, in_progress_at: ?int, expires_at: ?int, finalizing_at: ?int, completed_at: ?int, failed_at: ?int, expired_at: ?int, cancelling_at: ?int, cancelled_at: ?int, request_counts?: array{total: int, completed: int, failed: int}, metadata: ?array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $data = array_map(fn (array $result): BatchResponse => BatchResponse::from(
            $result,
            $meta,
        ), $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
            $attributes['first_id'],
            $attributes['last_id'],
            $attributes['has_more'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(
                static fn (BatchResponse $response): array => $response->toArray(),
                $this->data,
            ),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}
