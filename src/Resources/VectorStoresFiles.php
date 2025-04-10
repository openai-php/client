<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\VectorStoresFilesContract;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileDeleteResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileListResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class VectorStoresFiles implements VectorStoresFilesContract
{
    use Concerns\Transportable;

    /**
     * Create a file on a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files/createFile
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $vectorStoreId, array $parameters): VectorStoreFileResponse
    {
        $payload = Payload::create("vector_stores/$vectorStoreId/files", $parameters);

        /** @var Response<array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, attributes: array<string, string>, last_error: ?array{code: string, message: string}, chunking_strategy: array{type: 'static', static: array{max_chunk_size_tokens: int, chunk_overlap_tokens: int}}|array{type: 'other'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of files within a vector store.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files/listFiles
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $vectorStoreId, array $parameters = []): VectorStoreFileListResponse
    {
        $payload = Payload::list("vector_stores/$vectorStoreId/files", $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, attributes: array<string, string>, last_error: ?array{code: string, message: string}, chunking_strategy: array{type: 'static', static: array{max_chunk_size_tokens: int, chunk_overlap_tokens: int}}|array{type: 'other'}}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a file within a vector store.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files/getFile
     */
    public function retrieve(string $vectorStoreId, string $fileId): VectorStoreFileResponse
    {
        $payload = Payload::retrieve("vector_stores/$vectorStoreId/files", $fileId);

        /** @var Response<array{id: string, object: string, usage_bytes: int, created_at: int, vector_store_id: string, status: string, attributes: array<string, string>, last_error: ?array{code: string, message: string}, chunking_strategy: array{type: 'static', static: array{max_chunk_size_tokens: int, chunk_overlap_tokens: int}}|array{type: 'other'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete a file within a vector store.
     *
     * https://platform.openai.com/docs/api-reference/vector-stores/delete
     */
    public function delete(string $vectorStoreId, string $fileId): VectorStoreFileDeleteResponse
    {
        $payload = Payload::delete("vector_stores/$vectorStoreId/files", $fileId);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreFileDeleteResponse::from($response->data(), $response->meta());
    }
}
