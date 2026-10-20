<?php

use OpenAI\Responses\Vaults\Credentials\VaultCredentialListResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialResponse;

test('from', function () {
    $result = VaultCredentialListResponse::from(vaultCredentialListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(3)
        ->data->each->toBeInstanceOf(VaultCredentialResponse::class)
        ->firstId->toBe('credential_abc123')
        ->lastId->toBe('credential_ghi789')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = VaultCredentialListResponse::from(vaultCredentialListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = VaultCredentialListResponse::from(vaultCredentialListResource(), meta());

    expect($result->toArray())
        ->toBe(vaultCredentialListResource());
});

test('fake', function () {
    $response = VaultCredentialListResponse::fake();

    expect($response)
        ->toBeInstanceOf(VaultCredentialListResponse::class)
        ->data->each->toBeInstanceOf(VaultCredentialResponse::class);
});
