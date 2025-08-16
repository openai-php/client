<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ContainerFileContract;
use OpenAI\Resources\ContainerFile;
use OpenAI\Responses\Containers\Files\ContainerFileDeleteResponse;
use OpenAI\Responses\Containers\Files\ContainerFileListResponse;
use OpenAI\Responses\Containers\Files\ContainerFileResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ContainerFileTestResource implements ContainerFileContract
{
    use Testable;

    public function resource(): string
    {
        return ContainerFile::class;
    }

    public function create(string $containerId, array $parameters = []): ContainerFileResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $containerId, array $parameters = []): ContainerFileListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $containerId, string $fileId): ContainerFileResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function content(string $containerId, string $fileId): string
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $containerId, string $fileId): ContainerFileDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
