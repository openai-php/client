<?php

use OpenAI\Resources\VaultCredentials;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialDeleteResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialListResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialResponse;
use OpenAI\Testing\ClientFake;

it('records a vault credentials create request', function () {
    $fake = new ClientFake([
        VaultCredentialResponse::fake(),
    ]);

    $fake->vaults()->credentials()->create('vault_abc123', [
        'name' => 'Docs MCP token',
    ]);

    $fake->assertSent(VaultCredentials::class, function ($method, $vaultId, $parameters) {
        return $method === 'create' &&
            $vaultId === 'vault_abc123' &&
            $parameters['name'] === 'Docs MCP token';
    });
});

it('records a vault credentials list request', function () {
    $fake = new ClientFake([
        VaultCredentialListResponse::fake(),
    ]);

    $fake->vaults()->credentials()->list('vault_abc123');

    $fake->assertSent(VaultCredentials::class, function ($method, $vaultId) {
        return $method === 'list' &&
            $vaultId === 'vault_abc123';
    });
});

it('records a vault credentials retrieve request', function () {
    $fake = new ClientFake([
        VaultCredentialResponse::fake(),
    ]);

    $fake->vaults()->credentials()->retrieve('vault_abc123', 'credential_abc123');

    $fake->assertSent(VaultCredentials::class, function ($method, $vaultId, $credentialId) {
        return $method === 'retrieve' &&
            $vaultId === 'vault_abc123' &&
            $credentialId === 'credential_abc123';
    });
});

it('records a vault credentials update request', function () {
    $fake = new ClientFake([
        VaultCredentialResponse::fake(),
    ]);

    $fake->vaults()->credentials()->update('vault_abc123', 'credential_abc123', [
        'name' => 'Rotated token',
    ]);

    $fake->assertSent(VaultCredentials::class, function ($method, $vaultId, $credentialId, $parameters) {
        return $method === 'update' &&
            $vaultId === 'vault_abc123' &&
            $credentialId === 'credential_abc123' &&
            $parameters['name'] === 'Rotated token';
    });
});

it('records a vault credentials delete request', function () {
    $fake = new ClientFake([
        VaultCredentialDeleteResponse::fake(),
    ]);

    $fake->vaults()->credentials()->delete('vault_abc123', 'credential_abc123');

    $fake->assertSent(VaultCredentials::class, function ($method, $vaultId, $credentialId) {
        return $method === 'delete' &&
            $vaultId === 'vault_abc123' &&
            $credentialId === 'credential_abc123';
    });
});
