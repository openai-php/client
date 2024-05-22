<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\VectorStores\VectorStoreDeleteResponse;
use OpenAI\Responses\VectorStores\VectorStoreListResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponse;

interface VectorStoresContract
{
    /**
     * Modify a vector store
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/modify
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $vectorStore, array $parameters): VectorStoreResponse;

    /**
     * Retrieves a vector store.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/retrieve
     */
    public function retrieve(string $vectorStore): VectorStoreResponse;

    /**
     * Delete a vector store.
     *
     * https://platform.openai.com/docs/api-reference/vector-stores/delete
     */
    public function delete(string $vectorStore): VectorStoreDeleteResponse;

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
     */
    public function list(): VectorStoreListResponse;

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
