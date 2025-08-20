<?php

use OpenAI\Responses\Containers\Files\ContainerFileDeleteResponse;
use OpenAI\Responses\Containers\Files\ContainerFileListResponse;
use OpenAI\Responses\Containers\Files\ContainerFileResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('create with file_id', function () {
    $containerId = 'container_abc123';

    $client = mockClient('POST', "containers/$containerId/files", [
        'file_id' => 'file_abc123',
    ], Response::from(containerFileResource(), metaHeaders()));

    $result = $client->containers()->files()->create($containerId, [
        'file_id' => 'file_abc123',
    ]);

    expect($result)
        ->toBeInstanceOf(ContainerFileResponse::class)
        ->id->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->object->toBe('container.file')
        ->createdAt->toBe(1747848842)
        ->bytes->toBe(880)
        ->containerId->toBe('cntr_682e0e7318108198aa783fd921ff305e08e78805b9fdbb04')
        ->path->toBe('/mnt/data/88e12fa445d32636f190a0b33daed6cb-tsconfig.json')
        ->source->toBe('user');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create with file upload', function () {
    $containerId = 'container_upload123';

    $client = mockClient('POST', "containers/$containerId/files", [
        'file' => fileResourceResource(),
    ], Response::from(containerFileResource(), metaHeaders()), validateParams: false);

    $result = $client->containers()->files()->create($containerId, [
        'file' => fileResourceResource(),
    ]);

    expect($result)
        ->toBeInstanceOf(ContainerFileResponse::class);
});

test('create with both file_id and file throws', function () {
    $containerId = 'container_both123';

    OpenAI::client('foo')->containers()->files()->create($containerId, [
        'file_id' => 'file_abc',
        'file' => fileResourceResource(),
    ]);
})->throws(InvalidArgumentException::class, 'You cannot set both "file_id" and "file" parameters.');

test('list', function () {
    $containerId = 'container_list123';

    $client = mockClient('GET', "containers/$containerId/files", [], Response::from(containerFileListResource(), metaHeaders()));

    $result = $client->containers()->files()->list($containerId);

    expect($result)
        ->toBeInstanceOf(ContainerFileListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1)
        ->data->{0}->toBeInstanceOf(ContainerFileResponse::class)
        ->firstId->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->lastId->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->hasMore->toBe(false);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list with parameters', function () {
    $containerId = 'container_list_params';

    $client = mockClient('GET', "containers/$containerId/files", ['limit' => 1], Response::from(containerFileListResource(), metaHeaders()));

    $result = $client->containers()->files()->list($containerId, [
        'limit' => 1,
    ]);

    expect($result)
        ->toBeInstanceOf(ContainerFileListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1);
});

test('retrieve', function () {
    $containerId = 'container_retrieve123';
    $fileId = 'cfile_682e0e8a43c88191a7978f477a09bdf5';

    $client = mockClient('GET', "containers/$containerId/files/$fileId", [], Response::from(containerFileResource(), metaHeaders()));

    $result = $client->containers()->files()->retrieve($containerId, $fileId);

    expect($result)
        ->toBeInstanceOf(ContainerFileResponse::class)
        ->id->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->object->toBe('container.file')
        ->createdAt->toBe(1747848842)
        ->bytes->toBe(880)
        ->containerId->toBe('cntr_682e0e7318108198aa783fd921ff305e08e78805b9fdbb04')
        ->path->toBe('/mnt/data/88e12fa445d32636f190a0b33daed6cb-tsconfig.json')
        ->source->toBe('user');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('content', function () {
    $containerId = 'container_content123';
    $fileId = 'cfile_682e0e8a43c88191a7978f477a09bdf5';

    $client = mockContentClient('GET', "containers/{$containerId}/files/{$fileId}/content", [], 'file-content');

    $result = $client->containers()->files()->content($containerId, $fileId);

    expect($result)->toBe('file-content');
});

test('delete', function () {
    $containerId = 'container_delete123';
    $fileId = 'cfile_682e0e8a43c88191a7978f477a09bdf5';

    $client = mockClient('DELETE', "containers/$containerId/files/$fileId", [], Response::from(containerFileDeleteResource(), metaHeaders()));

    $result = $client->containers()->files()->delete($containerId, $fileId);

    expect($result)
        ->toBeInstanceOf(ContainerFileDeleteResponse::class)
        ->id->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->object->toBe('container.file.deleted')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
