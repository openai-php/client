<?php

use OpenAI\Resources\ContainerFile;
use OpenAI\Responses\Containers\Files\ContainerFileDeleteResponse;
use OpenAI\Responses\Containers\Files\ContainerFileListResponse;
use OpenAI\Responses\Containers\Files\ContainerFileResponse;
use OpenAI\Testing\ClientFake;

it('records a container files create request', function () {
    $fake = new ClientFake([
        ContainerFileResponse::from(containerFileResource(), meta()),
    ]);

    $fake->containers()->files()->create('container_abc123', [
        'file_id' => 'file_abc123',
    ]);

    $fake->assertSent(ContainerFile::class, function ($method, $containerId, $parameters) {
        return $method === 'create' &&
            $containerId === 'container_abc123' &&
            $parameters['file_id'] === 'file_abc123';
    });
});

it('records a container files list request', function () {
    $fake = new ClientFake([
        ContainerFileListResponse::from(containerFileListResource(), meta()),
    ]);

    $fake->containers()->files()->list('container_list123');

    $fake->assertSent(ContainerFile::class, function ($method, $containerId) {
        return $method === 'list' &&
            $containerId === 'container_list123';
    });
});

it('records a container files list request with parameters', function () {
    $fake = new ClientFake([
        ContainerFileListResponse::from(containerFileListResource(), meta()),
    ]);

    $fake->containers()->files()->list('container_list123', [
        'limit' => 1,
    ]);

    $fake->assertSent(ContainerFile::class, function ($method, $containerId, $parameters) {
        return $method === 'list' &&
            $containerId === 'container_list123' &&
            $parameters['limit'] === 1;
    });
});

it('records a container files retrieve request', function () {
    $fake = new ClientFake([
        ContainerFileResponse::from(containerFileResource(), meta()),
    ]);

    $fake->containers()->files()->retrieve('container_retrieve123', 'cfile_123');

    $fake->assertSent(ContainerFile::class, function ($method, $containerId, $fileId) {
        return $method === 'retrieve' &&
            $containerId === 'container_retrieve123' &&
            $fileId === 'cfile_123';
    });
});

it('records a container files content request', function () {
    $fake = new ClientFake([
        'file-content',
    ]);

    $fake->containers()->files()->content('container_content123', 'cfile_456');

    $fake->assertSent(ContainerFile::class, function ($method, $containerId, $fileId) {
        return $method === 'content' &&
            $containerId === 'container_content123' &&
            $fileId === 'cfile_456';
    });
});

it('records a container files delete request', function () {
    $fake = new ClientFake([
        ContainerFileDeleteResponse::from(containerFileDeleteResource(), meta()),
    ]);

    $fake->containers()->files()->delete('container_delete123', 'cfile_789');

    $fake->assertSent(ContainerFile::class, function ($method, $containerId, $fileId) {
        return $method === 'delete' &&
            $containerId === 'container_delete123' &&
            $fileId === 'cfile_789';
    });
});
