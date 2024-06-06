<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\VectorStores\VectorStoreDeleteResponse;
use OpenAI\Responses\VectorStores\VectorStoreListResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponse;

interface VectorStoresContract
{
    /**
     * Create a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): VectorStoreResponse;

    /**
     * Returns a list of vector stores.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): VectorStoreListResponse;

    /**
     * Retrieves a vector store.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/retrieve
     */
    public function retrieve(string $vectorStoreId): VectorStoreResponse;

    /**
     * Modify a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/modify
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $vectorStoreId, array $parameters): VectorStoreResponse;

    /**
     * Delete a vector store.
     *
     * https://platform.openai.com/docs/api-reference/vector-stores/delete
     */
    public function delete(string $vectorStoreId): VectorStoreDeleteResponse;

    /**
     * Manage the files related to the vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files
     */
    public function files(): VectorStoresFilesContract;

    /**
     * Manage the file batches related to the vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches
     */
    public function batches(): VectorStoresFileBatchesContract;
}
