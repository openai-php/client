<?php

use OpenAI\Responses\Vaults\Credentials\VaultCredentialDeleteResponse;

test('from', function () {
    $result = VaultCredentialDeleteResponse::from(vaultCredentialDeleteResource(), meta());

    expect($result)
        ->id->toBe('credential_abc123')
        ->object->toBe('vault.credential.deleted')
        ->deleted->toBeTrue();
});

test('as array accessible', function () {
    $result = VaultCredentialDeleteResponse::from(vaultCredentialDeleteResource(), meta());

    expect($result['deleted'])
        ->toBeTrue();
});

test('to array', function () {
    $result = VaultCredentialDeleteResponse::from(vaultCredentialDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(vaultCredentialDeleteResource());
});

test('fake', function () {
    $response = VaultCredentialDeleteResponse::fake();

    expect($response)
        ->toBeInstanceOf(VaultCredentialDeleteResponse::class)
        ->deleted->toBeTrue();
});
