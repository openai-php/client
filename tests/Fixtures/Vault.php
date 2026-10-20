<?php

/**
 * @return array<string, mixed>
 */
function vaultResource(): array
{
    return [
        'id' => 'vault_abc123',
        'object' => 'vault',
        'created_at' => 1760000000,
        'name' => 'Production',
        'metadata' => [
            'team' => 'support',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function vaultListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            vaultResource(),
            [
                'id' => 'vault_def456',
                'object' => 'vault',
                'created_at' => 1760000100,
                'name' => null,
                'metadata' => [],
            ],
        ],
        'first_id' => 'vault_abc123',
        'last_id' => 'vault_def456',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function vaultDeleteResource(): array
{
    return [
        'id' => 'vault_abc123',
        'object' => 'vault.deleted',
        'deleted' => true,
    ];
}
