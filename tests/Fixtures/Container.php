<?php

/**
 * @return array<string, mixed>
 */
function containerResource(): array
{
    return [
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
    ];
}

/**
 * @return array<string, mixed>
 */
function createContainerResource(): array
{
    return containerResource();
}

/**
 * @return array<string, mixed>
 */
function retrieveContainerResource(): array
{
    return containerResource();
}

/**
 * @return array<string, mixed>
 */
function listContainersResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            containerResource(),
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
    ];
}

/**
 * @return array<string, mixed>
 */
function deleteContainerResource(): array
{
    return [
        'id' => 'container_abc123',
        'object' => 'container',
        'deleted' => true,
    ];
}
