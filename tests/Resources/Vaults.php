<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Vaults\VaultDeleteResponse;
use OpenAI\Responses\Vaults\VaultListResponse;
use OpenAI\Responses\Vaults\VaultResponse;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'vaults', [
        'name' => 'Production',
        'metadata' => ['team' => 'support'],
    ], Response::from(vaultResource(), metaHeaders()));

    $result = $client->vaults()->create([
        'name' => 'Production',
        'metadata' => ['team' => 'support'],
    ]);

    expect($result)
        ->toBeInstanceOf(VaultResponse::class)
        ->id->toBe('vault_abc123')
        ->object->toBe('vault')
        ->createdAt->toBe(1760000000)
        ->name->toBe('Production')
        ->metadata->toBe(['team' => 'support']);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'vaults', [
        'limit' => 10,
    ], Response::from(vaultListResource(), metaHeaders()));

    $result = $client->vaults()->list([
        'limit' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(VaultListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(VaultResponse::class)
        ->firstId->toBe('vault_abc123')
        ->lastId->toBe('vault_def456')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'vaults/vault_abc123', [], Response::from(vaultResource(), metaHeaders()));

    $result = $client->vaults()->retrieve('vault_abc123');

    expect($result)
        ->toBeInstanceOf(VaultResponse::class)
        ->id->toBe('vault_abc123')
        ->name->toBe('Production');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('update', function () {
    $client = mockClient('POST', 'vaults/vault_abc123', [
        'name' => 'Production',
    ], Response::from(vaultResource(), metaHeaders()));

    $result = $client->vaults()->update('vault_abc123', [
        'name' => 'Production',
    ]);

    expect($result)
        ->toBeInstanceOf(VaultResponse::class)
        ->id->toBe('vault_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'vaults/vault_abc123', [], Response::from(vaultDeleteResource(), metaHeaders()));

    $result = $client->vaults()->delete('vault_abc123');

    expect($result)
        ->toBeInstanceOf(VaultDeleteResponse::class)
        ->id->toBe('vault_abc123')
        ->object->toBe('vault.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
