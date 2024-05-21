<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\VectorStoresContract;
use OpenAI\Contracts\Resources\VectorStoresFilesContract;
use OpenAI\Responses\VectorStores\VectorStoreDeleteResponse;
use OpenAI\Responses\VectorStores\VectorStoreListResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class VectorStores implements VectorStoresContract
{
    use Concerns\Transportable;

    /**
     * Create a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): VectorStoreResponse
    {
        $payload = Payload::create('vector_stores', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: <string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of vector stores.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/list
     */
    public function list(): VectorStoreListResponse
    {
        $payload = Payload::list('vector_stores');

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: <string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a vector store.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/retrieve
     */
    public function retrieve(string $vectorStore): VectorStoreResponse
    {
        $payload = Payload::retrieve('vector_stores', $vectorStore);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: <string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreResponse::from($response->data(), $response->meta());
    }

    /**
     * Modify a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/modify
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $vectorStore, array $parameters): VectorStoreResponse
    {
        $payload = Payload::modify('vector_stores', $vectorStore, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: <string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete a vector store.
     *
     * https://platform.openai.com/docs/api-reference/vector-stores/delete
     */
    public function delete(string $vectorStore): VectorStoreDeleteResponse
    {
        $payload = Payload::delete('vector_stores', $vectorStore);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage the files related to the vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files
     */
    public function files(): VectorStoresFilesContract
    {
        return new VectorStoresFiles($this->transporter);
    }
}
