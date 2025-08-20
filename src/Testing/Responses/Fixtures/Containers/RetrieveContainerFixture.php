<?php

namespace OpenAI\Testing\Responses\Fixtures\Containers;

final class RetrieveContainerFixture
{
    public const ATTRIBUTES = [
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
