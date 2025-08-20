<?php

namespace OpenAI\Testing\Responses\Fixtures\Containers;

final class ListContainersFixture
{
    public const ATTRIBUTES = [
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
    ];
}
