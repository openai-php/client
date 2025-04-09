<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Batches\BatchListResponse;
use OpenAI\Responses\Batches\BatchResponse;

interface BatchesContract
{
    /**
     * Creates and executes a batch from an uploaded file of requests
     *
     * @see https://platform.openai.com/docs/api-reference/batch/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): BatchResponse;

    /**
     * Retrieves a batch.
     * *
     * @see https://platform.openai.com/docs/api-reference/batch/retrieve
     */
    public function retrieve(string $id): BatchResponse;

    /**
     * Cancels an in-progress batch.
     * *
     * @see https://platform.openai.com/docs/api-reference/batch/cancel
     */
    public function cancel(string $id): BatchResponse;

    /**
     * List your organization's batches.
     *
     * @see https://platform.openai.com/docs/api-reference/batch/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): BatchListResponse;
}
