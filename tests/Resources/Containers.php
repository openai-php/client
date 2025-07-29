<?php

use OpenAI\Responses\Containers\CreateContainer;
use OpenAI\Responses\Containers\DeleteContainer;
use OpenAI\Responses\Containers\ListContainers;
use OpenAI\Responses\Containers\Objects\ExpiresAfter;
use OpenAI\Responses\Containers\RetrieveContainer;
use OpenAI\Responses\Meta\MetaInformation;

test('create', function () {
    $client = mockClient('POST', 'containers', [
        'name' => 'Test Container',
    ], \OpenAI\ValueObjects\Transporter\Response::from(createContainerResource(), metaHeaders()));

    $result = $client->containers()->create([
        'name' => 'Test Container',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateContainer::class)
        ->id->toBe('container_abc123')
        ->object->toBe('container')
        ->createdAt->toBe(1690000000)
        ->status->toBe('active')
        ->expiresAfter->toBeInstanceOf(ExpiresAfter::class)
        ->lastActiveAt->toBe(1690001000)
        ->name->toBe('Test Container');

    expect($result->expiresAfter)
        ->anchor->toBe('last_active_at')
        ->minutes->toBe(60);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'containers/container_abc123', [],
        \OpenAI\ValueObjects\Transporter\Response::from(retrieveContainerResource(), metaHeaders()));

    $result = $client->containers()->retrieve('container_abc123');

    expect($result)
        ->toBeInstanceOf(RetrieveContainer::class)
        ->id->toBe('container_abc123')
        ->object->toBe('container')
        ->createdAt->toBe(1690000000)
        ->status->toBe('active')
        ->expiresAfter->toBeInstanceOf(ExpiresAfter::class)
        ->lastActiveAt->toBe(1690001000)
        ->name->toBe('Test Container');

    expect($result->expiresAfter)
        ->anchor->toBe('last_active_at')
        ->minutes->toBe(60);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'containers/container_abc123', [],
        \OpenAI\ValueObjects\Transporter\Response::from(deleteContainerResource(), metaHeaders()));

    $result = $client->containers()->delete('container_abc123');

    expect($result)
        ->toBeInstanceOf(DeleteContainer::class)
        ->id->toBe('container_abc123')
        ->object->toBe('container')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'containers', [],
        \OpenAI\ValueObjects\Transporter\Response::from(listContainersResource(), metaHeaders()));

    $result = $client->containers()->list();

    expect($result)
        ->toBeInstanceOf(ListContainers::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->firstId->toBe('container_abc123')
        ->lastId->toBe('container_def456')
        ->hasMore->toBe(false);

    expect($result->data[0])
        ->toBeInstanceOf(RetrieveContainer::class)
        ->id->toBe('container_abc123')
        ->name->toBe('Test Container');

    expect($result->data[1])
        ->toBeInstanceOf(RetrieveContainer::class)
        ->id->toBe('container_def456')
        ->name->toBe('Another Test Container');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list with parameters', function () {
    $client = mockClient('GET', 'containers', ['limit' => 2],
        \OpenAI\ValueObjects\Transporter\Response::from(listContainersResource(), metaHeaders()));

    $result = $client->containers()->list([
        'limit' => 2,
    ]);

    expect($result)
        ->toBeInstanceOf(ListContainers::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2);
});
