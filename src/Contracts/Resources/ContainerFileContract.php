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
     * @see https://platform.openai.com/docs/api-reference/container_files/createContainerFile
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $containerId, array $parameters = []): ContainerFileResponse;

    /**
     * List container files
     *
     * @see https://platform.openai.com/docs/api-reference/container_files/listContainerFiles
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $containerId, array $parameters = []): ContainerFileListResponse;

    /**
     * Retrieve a container file
     *
     * @see https://platform.openai.com/docs/api-reference/container_files/retrieveContainerFile
     */
    public function retrieve(string $containerId, string $fileId): ContainerFileResponse;

    /**
     * Retrieve container file content
     *
     * @see https://platform.openai.com/docs/api-reference/container_files/retrieveContainerFileContent
     */
    public function content(string $containerId, string $fileId): string;

    /**
     * Delete a container file
     *
     * @see https://platform.openai.com/docs/api-reference/container_files/deleteContainerFile
     */
    public function delete(string $containerId, string $fileId): ContainerFileDeleteResponse;
}
