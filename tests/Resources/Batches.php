<?php

use OpenAI\Responses\Batches\BatchListResponse;
use OpenAI\Responses\Batches\BatchResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'batches', [], Response::from(batchListResource(), metaHeaders()));

    $result = $client->batches()->list();

    expect($result)
        ->toBeInstanceOf(BatchListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(4)
        ->data->each->toBeInstanceOf(BatchResponse::class)
        ->firstId->toBe('batch_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->lastId->toBe('batch_y49lAdZDiaQUxEBR6zrG846Q')
        ->hasMore->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create', function () {
    $client = mockClient('POST', 'batches', [
        'input_file_id' => 'file-abc123',
        'endpoint' => '/v1/chat/completions',
        'completion_window' => '24h',
    ], Response::from(batchResource(), metaHeaders()));

    $result = $client->batches()->create([
        'input_file_id' => 'file-abc123',
        'endpoint' => '/v1/chat/completions',
        'completion_window' => '24h',
    ]);

    expect($result)
        ->toBeInstanceOf(BatchResponse::class)
        ->id->toBe('batch_abc123')
        ->object->toBe('batch')
        ->createdAt->toBe(1711471533)
        ->errors->toBeNull()
        ->status->toBe('completed')
        ->completionWindow->toBe('24h')
        ->requestCounts->toBeInstanceOf(\OpenAI\Responses\Batches\BatchResponseRequestCounts::class)
        ->requestCounts->total->toBe(100)
        ->metadata->toBeArray()->toHaveCount(2);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'batches/batch_abc123', [], Response::from(batchResource(), metaHeaders()));

    $result = $client->batches()->retrieve('batch_abc123');

    expect($result)
        ->toBeInstanceOf(BatchResponse::class)
        ->id->toBe('batch_abc123')
        ->object->toBe('batch')
        ->createdAt->toBe(1711471533)
        ->errors->toBeNull()
        ->status->toBe('completed')
        ->completionWindow->toBe('24h')
        ->requestCounts->toBeInstanceOf(\OpenAI\Responses\Batches\BatchResponseRequestCounts::class)
        ->requestCounts->total->toBe(100)
        ->metadata->toBeArray()->toHaveCount(2);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('cancel', function () {
    $client = mockClient('POST', 'batches/batch_abc123/cancel', [], Response::from(batchResource(), metaHeaders()));

    $result = $client->batches()->cancel('batch_abc123');

    expect($result)
        ->toBeInstanceOf(BatchResponse::class)
        ->id->toBe('batch_abc123')
        ->object->toBe('batch')
        ->createdAt->toBe(1711471533)
        ->errors->toBeNull()
        ->status->toBe('completed')
        ->completionWindow->toBe('24h')
        ->requestCounts->toBeInstanceOf(\OpenAI\Responses\Batches\BatchResponseRequestCounts::class)
        ->requestCounts->total->toBe(100)
        ->metadata->toBeArray()->toHaveCount(2);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
