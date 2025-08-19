<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ContainerFileContract;
use OpenAI\Responses\Containers\Files\ContainerFileDeleteResponse;
use OpenAI\Responses\Containers\Files\ContainerFileListResponse;
use OpenAI\Responses\Containers\Files\ContainerFileResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type ContainerFileType from ContainerFileResponse
 * @phpstan-import-type ContainerFileListType from ContainerFileListResponse
 * @phpstan-import-type ContainerFileDeleteType from ContainerFileDeleteResponse
 */
final class ContainerFile implements ContainerFileContract
{
    use Concerns\Transportable;

    /**
     * Create a container file
     *
     * @see https://platform.openai.com/docs/api-reference/containers/create-container-file
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $containerId, array $parameters = []): ContainerFileResponse
    {
        if (isset($parameters['file_id']) && isset($parameters['file'])) {
            throw new \InvalidArgumentException('You cannot set both "file_id" and "file" parameters.');
        }

        $url = "containers/$containerId/files";
        $payload = isset($parameters['file'])
            ? Payload::upload($url, $parameters)
            : Payload::create($url, $parameters);

        /** @var Response<ContainerFileType> $response */
        $response = $this->transporter->requestObject($payload);

        return ContainerFileResponse::from($response->data(), $response->meta());
    }

    /**
     * List container files
     *
     * @see https://platform.openai.com/docs/api-reference/containers/list-container-files
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $containerId, array $parameters = []): ContainerFileListResponse
    {
        $payload = Payload::list("containers/$containerId/files", $parameters);

        /** @var Response<ContainerFileListType> $response */
        $response = $this->transporter->requestObject($payload);

        return ContainerFileListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve a container file
     *
     * @see https://platform.openai.com/docs/api-reference/containers/retrieve-container-file
     */
    public function retrieve(string $containerId, string $fileId): ContainerFileResponse
    {
        $payload = Payload::retrieve("containers/$containerId/files", $fileId);

        /** @var Response<ContainerFileType> $response */
        $response = $this->transporter->requestObject($payload);

        return ContainerFileResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve container file content
     *
     * @see https://platform.openai.com/docs/api-reference/containers/retrieve-container-file-content
     */
    public function content(string $containerId, string $fileId): string
    {
        $payload = Payload::retrieveContent("containers/$containerId/files", $fileId);

        return $this->transporter->requestContent($payload);
    }

    /**
     * Delete a container file
     *
     * @see https://platform.openai.com/docs/api-reference/containers/delete-container-file
     */
    public function delete(string $containerId, string $fileId): ContainerFileDeleteResponse
    {
        $payload = Payload::delete("containers/$containerId/files", $fileId);

        /** @var Response<ContainerFileDeleteType> $response */
        $response = $this->transporter->requestObject($payload);

        return ContainerFileDeleteResponse::from($response->data(), $response->meta());
    }
}
