<?php

use OpenAI\Responses\Containers\ListContainers;
use OpenAI\Responses\Containers\RetrieveContainer;

test('from', function () {
    $result = ListContainers::from(listContainersResource(), meta());

    expect($result)
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
});

test('to array', function () {
    $result = ListContainers::from(listContainersResource(), meta());

    expect($result->toArray())
        ->toBe([
            'object' => 'list',
            'data' => [
                [
                    'id' => 'container_abc123',
                    'object' => 'container',
                    'created_at' => 1690000000,
                    'status' => 'active',
                    'expires_after' => [
                        'anchor' => 'last_active_at',
                        'minutes' => 60,
                    ],
                    'last_active_at' => 1690001000,
                    'name' => 'Test Container',
                ],
                [
                    'id' => 'container_def456',
                    'object' => 'container',
                    'created_at' => 1690010000,
                    'status' => 'active',
                    'expires_after' => [
                        'anchor' => 'last_active_at',
                        'minutes' => 120,
                    ],
                    'last_active_at' => 1690011000,
                    'name' => 'Another Test Container',
                ],
            ],
            'first_id' => 'container_abc123',
            'last_id' => 'container_def456',
            'has_more' => false,
        ]);
});
