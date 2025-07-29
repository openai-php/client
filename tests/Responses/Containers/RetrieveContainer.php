<?php

use OpenAI\Responses\Containers\Objects\ExpiresAfter;
use OpenAI\Responses\Containers\RetrieveContainer;

test('from', function () {
    $result = RetrieveContainer::from(retrieveContainerResource(), meta());

    expect($result)
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
});

test('to array', function () {
    $result = RetrieveContainer::from(retrieveContainerResource(), meta());

    expect($result->toArray())
        ->toBe([
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
        ]);
});
