<?php

use OpenAI\Responses\Vaults\VaultDeleteResponse;

test('from', function () {
    $result = VaultDeleteResponse::from(vaultDeleteResource(), meta());

    expect($result)
        ->id->toBe('vault_abc123')
        ->object->toBe('vault.deleted')
        ->deleted->toBeTrue();
});

test('as array accessible', function () {
    $result = VaultDeleteResponse::from(vaultDeleteResource(), meta());

    expect($result['deleted'])
        ->toBeTrue();
});

test('to array', function () {
    $result = VaultDeleteResponse::from(vaultDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(vaultDeleteResource());
});

test('fake', function () {
    $response = VaultDeleteResponse::fake();

    expect($response)
        ->toBeInstanceOf(VaultDeleteResponse::class)
        ->deleted->toBeTrue();
});
