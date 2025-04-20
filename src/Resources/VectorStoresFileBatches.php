<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\VectorStoresFileBatchesContract;
use OpenAI\Responses\VectorStores\FileBatches\VectorStoreFileBatchResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileListResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class VectorStoresFileBatches implements VectorStoresFileBatchesContract
{
    use Concerns\Transportable;

    /**
     * Create a file batch on a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/createBatch
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $vectorStoreId, array $parameters): VectorStoreFileBatchResponse
    {
        $payload = Payload::create("vector_stores/$vectorStoreId/file_batches", $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, vector_store_id: string, status: string, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileBatchResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a file batch within a vector store.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/getBatch
     */
    public function retrieve(string $vectorStoreId, string $fileBatchId): VectorStoreFileBatchResponse
    {
        $payload = Payload::retrieve("vector_stores/$vectorStoreId/file_batches", $fileBatchId);

        /** @var Response<array{id: string, object: string, created_at: int, vector_store_id: string, status: string, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileBatchResponse::from($response->data(), $response->meta());
    }

    /**
     * Lists the files within a file batch within a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/listBatchFiles
     *
     * @param  array<string, mixed>  $parameters
     */
    public function listFiles(string $vectorStoreId, string $fileBatchId, array $parameters = []): VectorStoreFileListResponse
    {
        $payload = Payload::list("vector_stores/$vectorStoreId/file_batches/$fileBatchId/files", $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, attributes: array<string, string>, last_error: ?array{code: string, message: string}, chunking_strategy: array{type: 'static', static: array{max_chunk_size_tokens: int, chunk_overlap_tokens: int}}|array{type: 'other'}}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileListResponse::from($response->data(), $response->meta());
    }

    /**
     * Cancel a vector store file batch
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/cancelBatch
     */
    public function cancel(string $vectorStoreId, string $fileBatchId): VectorStoreFileBatchResponse
    {
        $payload = Payload::cancel("vector_stores/$vectorStoreId/file_batches", $fileBatchId);

        /** @var Response<array{id: string, object: string, created_at: int, vector_store_id: string, status: string, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileBatchResponse::from($response->data(), $response->meta());
    }
}
