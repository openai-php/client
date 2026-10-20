<?php

/**
 * @return array<string, mixed>
 */
function vaultCredentialResource(): array
{
    return [
        'id' => 'credential_abc123',
        'object' => 'vault.credential',
        'created_at' => 1760000000,
        'updated_at' => 1760000100,
        'vault_id' => 'vault_abc123',
        'name' => 'Docs MCP token',
        'metadata' => [
            'owner' => 'platform',
        ],
        'auth' => [
            'type' => 'static_bearer',
            'mcp_server_url' => 'https://example.com/mcp',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function vaultCredentialListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            vaultCredentialResource(),
            [
                'id' => 'credential_def456',
                'object' => 'vault.credential',
                'created_at' => 1760000200,
                'updated_at' => 1760000200,
                'vault_id' => 'vault_abc123',
                'name' => 'CRM OAuth',
                'metadata' => [],
                'auth' => [
                    'type' => 'mcp_oauth',
                    'mcp_server_url' => 'https://crm.example.com/mcp',
                    'expires_at' => '2026-12-01T00:00:00Z',
                    'refresh' => [
                        'client_id' => 'client_123',
                        'resource' => null,
                        'scope' => 'read write',
                        'token_endpoint' => 'https://crm.example.com/oauth/token',
                        'token_endpoint_auth' => [
                            'type' => 'client_secret_post',
                        ],
                    ],
                ],
            ],
            [
                'id' => 'credential_ghi789',
                'object' => 'vault.credential',
                'created_at' => 1760000300,
                'updated_at' => 1760000300,
                'vault_id' => 'vault_abc123',
                'name' => 'Billing API key',
                'metadata' => [],
                'auth' => [
                    'type' => 'environment_variable',
                    'secret_name' => 'BILLING_API_KEY',
                    'networking' => [
                        'type' => 'limited',
                        'allowed_hosts' => ['api.billing.example.com'],
                    ],
                ],
            ],
        ],
        'first_id' => 'credential_abc123',
        'last_id' => 'credential_ghi789',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function vaultCredentialDeleteResource(): array
{
    return [
        'id' => 'credential_abc123',
        'object' => 'vault.credential.deleted',
        'deleted' => true,
    ];
}
