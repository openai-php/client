<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Containers\Files\ContainerFileDeleteResponse;
use OpenAI\Responses\Containers\Files\ContainerFileListResponse;
use OpenAI\Responses\Containers\Files\ContainerFileResponse;

interface ContainerFileContract
{
    /**
     * Create a container file
     *
     * @see https://platform.openai.com/docs/api-reference/containers/create-container-file
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $containerId, array $parameters = []): ContainerFileResponse;

    /**
     * List container files
     *
     * @see https://platform.openai.com/docs/api-reference/containers/list-container-files
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $containerId, array $parameters = []): ContainerFileListResponse;

    /**
     * Retrieve a container file
     *
     * @see https://platform.openai.com/docs/api-reference/containers/retrieve-container-file
     */
    public function retrieve(string $containerId, string $fileId): ContainerFileResponse;

    /**
     * Retrieve container file content
     *
     * @see https://platform.openai.com/docs/api-reference/containers/retrieve-container-file-content
     */
    public function content(string $containerId, string $fileId): string;

    /**
     * Delete a container file
     *
     * @see https://platform.openai.com/docs/api-reference/containers/delete-container-file
     */
    public function delete(string $containerId, string $fileId): ContainerFileDeleteResponse;
}
