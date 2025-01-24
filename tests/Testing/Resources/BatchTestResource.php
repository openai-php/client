<?php

use OpenAI\Resources\Batches;
use OpenAI\Responses\Batches\BatchListResponse;
use OpenAI\Responses\Batches\BatchResponse;
use OpenAI\Testing\ClientFake;

it('records an batch create request', function () {
    $fake = new ClientFake([
        BatchResponse::fake(),
    ]);

    $fake->batches()->create([
        'input_file_id' => 'file-abc123',
        'endpoint' => '/v1/chat/completions',
        'completion_window' => '24h',
    ]);

    $fake->assertSent(Batches::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['input_file_id'] === 'file-abc123' &&
            $parameters['endpoint'] === '/v1/chat/completions' &&
            $parameters['completion_window'] === '24h';
    });
});

it('records an batch retrieve request', function () {
    $fake = new ClientFake([
        BatchResponse::fake(),
    ]);

    $fake->batches()->retrieve('batch_abc123');

    $fake->assertSent(Batches::class, function ($method, $batchId) {
        return $method === 'retrieve' &&
            $batchId === 'batch_abc123';
    });
});

it('records an batch cancel request', function () {
    $fake = new ClientFake([
        BatchResponse::fake(),
    ]);

    $fake->batches()->cancel('batch_abc123');

    $fake->assertSent(Batches::class, function ($method, $batchId) {
        return $method === 'cancel' &&
            $batchId === 'batch_abc123';
    });
});

it('records an batch list request', function () {
    $fake = new ClientFake([
        BatchListResponse::fake(),
    ]);

    $fake->batches()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(Batches::class, function ($method) {
        return $method === 'list';
    });
});
