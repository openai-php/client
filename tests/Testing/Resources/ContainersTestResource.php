<?php

use OpenAI\Resources\Containers;
use OpenAI\Responses\Containers\CreateContainer;
use OpenAI\Responses\Containers\DeleteContainer;
use OpenAI\Responses\Containers\ListContainers;
use OpenAI\Responses\Containers\RetrieveContainer;
use OpenAI\Testing\ClientFake;

it('records a containers create request', function () {
    $fake = new ClientFake([
        CreateContainer::from(createContainerResource(), meta()),
    ]);

    $fake->containers()->create([
        'name' => 'Test Container',
    ]);

    $fake->assertSent(Containers::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['name'] === 'Test Container';
    });
});

it('records a containers retrieve request', function () {
    $fake = new ClientFake([
        RetrieveContainer::from(retrieveContainerResource(), meta()),
    ]);

    $fake->containers()->retrieve('container_abc123');

    $fake->assertSent(Containers::class, function ($method, $id) {
        return $method === 'retrieve' &&
            $id === 'container_abc123';
    });
});

it('records a containers delete request', function () {
    $fake = new ClientFake([
        DeleteContainer::from(deleteContainerResource(), meta()),
    ]);

    $fake->containers()->delete('container_abc123');

    $fake->assertSent(Containers::class, function ($method, $id) {
        return $method === 'delete' &&
            $id === 'container_abc123';
    });
});

it('records a containers list request', function () {
    $fake = new ClientFake([
        ListContainers::from(listContainersResource(), meta()),
    ]);

    $fake->containers()->list();

    $fake->assertSent(Containers::class, function ($method) {
        return $method === 'list';
    });
});

it('records a containers list request with parameters', function () {
    $fake = new ClientFake([
        ListContainers::from(listContainersResource(), meta()),
    ]);

    $fake->containers()->list([
        'limit' => 2,
    ]);

    $fake->assertSent(Containers::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 2;
    });
});
