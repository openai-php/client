<?php

use OpenAI\Resources\Vaults;
use OpenAI\Responses\Vaults\VaultDeleteResponse;
use OpenAI\Responses\Vaults\VaultListResponse;
use OpenAI\Responses\Vaults\VaultResponse;
use OpenAI\Testing\ClientFake;

it('records a vaults create request', function () {
    $fake = new ClientFake([
        VaultResponse::fake(),
    ]);

    $fake->vaults()->create([
        'name' => 'Production',
    ]);

    $fake->assertSent(Vaults::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['name'] === 'Production';
    });
});

it('records a vaults list request', function () {
    $fake = new ClientFake([
        VaultListResponse::fake(),
    ]);

    $fake->vaults()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(Vaults::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 10;
    });
});

it('records a vaults retrieve request', function () {
    $fake = new ClientFake([
        VaultResponse::fake(),
    ]);

    $fake->vaults()->retrieve('vault_abc123');

    $fake->assertSent(Vaults::class, function ($method, $id) {
        return $method === 'retrieve' &&
            $id === 'vault_abc123';
    });
});

it('records a vaults update request', function () {
    $fake = new ClientFake([
        VaultResponse::fake(),
    ]);

    $fake->vaults()->update('vault_abc123', [
        'name' => 'Staging',
    ]);

    $fake->assertSent(Vaults::class, function ($method, $id, $parameters) {
        return $method === 'update' &&
            $id === 'vault_abc123' &&
            $parameters['name'] === 'Staging';
    });
});

it('records a vaults delete request', function () {
    $fake = new ClientFake([
        VaultDeleteResponse::fake(),
    ]);

    $fake->vaults()->delete('vault_abc123');

    $fake->assertSent(Vaults::class, function ($method, $id) {
        return $method === 'delete' &&
            $id === 'vault_abc123';
    });
});
