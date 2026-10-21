<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialDeleteResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialListResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialResponse;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'vaults/vault_abc123/credentials', [
        'name' => 'Docs MCP token',
        'auth' => [
            'type' => 'static_bearer',
            'mcp_server_url' => 'https://example.com/mcp',
            'token' => 'secret-token',
        ],
    ], Response::from(vaultCredentialResource(), metaHeaders()));

    $result = $client->vaults()->credentials()->create('vault_abc123', [
        'name' => 'Docs MCP token',
        'auth' => [
            'type' => 'static_bearer',
            'mcp_server_url' => 'https://example.com/mcp',
            'token' => 'secret-token',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(VaultCredentialResponse::class)
        ->id->toBe('credential_abc123')
        ->object->toBe('vault.credential')
        ->createdAt->toBe(1760000000)
        ->updatedAt->toBe(1760000100)
        ->vaultId->toBe('vault_abc123')
        ->name->toBe('Docs MCP token')
        ->metadata->toBe(['owner' => 'platform'])
        ->auth->toBe(['type' => 'static_bearer', 'mcp_server_url' => 'https://example.com/mcp']);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'vaults/vault_abc123/credentials', [
        'status' => 'active',
    ], Response::from(vaultCredentialListResource(), metaHeaders()));

    $result = $client->vaults()->credentials()->list('vault_abc123', [
        'status' => 'active',
    ]);

    expect($result)
        ->toBeInstanceOf(VaultCredentialListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(3)
        ->data->each->toBeInstanceOf(VaultCredentialResponse::class)
        ->firstId->toBe('credential_abc123')
        ->lastId->toBe('credential_ghi789')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'vaults/vault_abc123/credentials/credential_abc123', [], Response::from(vaultCredentialResource(), metaHeaders()));

    $result = $client->vaults()->credentials()->retrieve('vault_abc123', 'credential_abc123');

    expect($result)
        ->toBeInstanceOf(VaultCredentialResponse::class)
        ->id->toBe('credential_abc123')
        ->vaultId->toBe('vault_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('update', function () {
    $client = mockClient('POST', 'vaults/vault_abc123/credentials/credential_abc123', [
        'auth' => [
            'type' => 'static_bearer',
            'token' => 'rotated-token',
        ],
    ], Response::from(vaultCredentialResource(), metaHeaders()));

    $result = $client->vaults()->credentials()->update('vault_abc123', 'credential_abc123', [
        'auth' => [
            'type' => 'static_bearer',
            'token' => 'rotated-token',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(VaultCredentialResponse::class)
        ->id->toBe('credential_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'vaults/vault_abc123/credentials/credential_abc123', [], Response::from(vaultCredentialDeleteResource(), metaHeaders()));

    $result = $client->vaults()->credentials()->delete('vault_abc123', 'credential_abc123');

    expect($result)
        ->toBeInstanceOf(VaultCredentialDeleteResponse::class)
        ->id->toBe('credential_abc123')
        ->object->toBe('vault.credential.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
