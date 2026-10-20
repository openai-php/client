<?php

use OpenAI\Responses\Vaults\VaultResponse;

test('from', function () {
    $result = VaultResponse::from(vaultResource(), meta());

    expect($result)
        ->id->toBe('vault_abc123')
        ->object->toBe('vault')
        ->createdAt->toBe(1760000000)
        ->name->toBe('Production')
        ->metadata->toBe(['team' => 'support']);
});

test('from with a null name', function () {
    $result = VaultResponse::from(vaultListResource()['data'][1], meta());

    expect($result)
        ->name->toBeNull()
        ->metadata->toBe([]);
});

test('as array accessible', function () {
    $result = VaultResponse::from(vaultResource(), meta());

    expect($result['name'])
        ->toBe('Production');
});

test('to array', function () {
    $result = VaultResponse::from(vaultResource(), meta());

    expect($result->toArray())
        ->toBe(vaultResource());
});

test('fake', function () {
    $response = VaultResponse::fake();

    expect($response)
        ->toBeInstanceOf(VaultResponse::class)
        ->object->toBe('vault');
});
