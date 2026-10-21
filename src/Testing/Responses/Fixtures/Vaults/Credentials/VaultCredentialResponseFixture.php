<?php

namespace OpenAI\Testing\Responses\Fixtures\Vaults\Credentials;

final class VaultCredentialResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'credential_abc123',
        'object' => 'vault.credential',
        'created_at' => 1760000000,
        'updated_at' => 1760000000,
        'vault_id' => 'vault_abc123',
        'name' => 'Docs MCP token',
        'metadata' => [],
        'auth' => [
            'type' => 'static_bearer',
            'mcp_server_url' => 'https://example.com/mcp',
        ],
    ];
}
