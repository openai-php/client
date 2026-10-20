<?php

use OpenAI\Responses\Vaults\Credentials\VaultCredentialResponse;

test('from', function () {
    $result = VaultCredentialResponse::from(vaultCredentialResource(), meta());

    expect($result)
        ->id->toBe('credential_abc123')
        ->object->toBe('vault.credential')
        ->createdAt->toBe(1760000000)
        ->updatedAt->toBe(1760000100)
        ->vaultId->toBe('vault_abc123')
        ->name->toBe('Docs MCP token')
        ->metadata->toBe(['owner' => 'platform'])
        ->auth->toBe(['type' => 'static_bearer', 'mcp_server_url' => 'https://example.com/mcp']);
});

test('from with each auth type', function () {
    $credentials = vaultCredentialListResource()['data'];

    $oauth = VaultCredentialResponse::from($credentials[1], meta());
    expect($oauth->auth['type'])->toBe('mcp_oauth');
    expect($oauth->auth['refresh']['token_endpoint_auth'])->toBe(['type' => 'client_secret_post']);

    $environment = VaultCredentialResponse::from($credentials[2], meta());
    expect($environment->auth['type'])->toBe('environment_variable');
    expect($environment->auth['networking'])->toBe(['type' => 'limited', 'allowed_hosts' => ['api.billing.example.com']]);
});

test('as array accessible', function () {
    $result = VaultCredentialResponse::from(vaultCredentialResource(), meta());

    expect($result['vault_id'])
        ->toBe('vault_abc123');
});

test('to array', function () {
    $result = VaultCredentialResponse::from(vaultCredentialResource(), meta());

    expect($result->toArray())
        ->toBe(vaultCredentialResource());
});

test('fake', function () {
    $response = VaultCredentialResponse::fake();

    expect($response)
        ->toBeInstanceOf(VaultCredentialResponse::class)
        ->object->toBe('vault.credential');
});
