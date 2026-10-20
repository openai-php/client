<?php

use OpenAI\Responses\Vaults\VaultListResponse;
use OpenAI\Responses\Vaults\VaultResponse;

test('from', function () {
    $result = VaultListResponse::from(vaultListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(VaultResponse::class)
        ->firstId->toBe('vault_abc123')
        ->lastId->toBe('vault_def456')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = VaultListResponse::from(vaultListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = VaultListResponse::from(vaultListResource(), meta());

    expect($result->toArray())
        ->toBe(vaultListResource());
});

test('fake', function () {
    $response = VaultListResponse::fake();

    expect($response)
        ->toBeInstanceOf(VaultListResponse::class)
        ->data->each->toBeInstanceOf(VaultResponse::class);
});
