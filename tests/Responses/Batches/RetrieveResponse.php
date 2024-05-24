<?php

use OpenAI\Responses\Batches\BatchResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = BatchResponse::from(batchResource(), meta());

    expect($result)
        ->toBeInstanceOf(BatchResponse::class)
        ->id->toBe('batch_abc123')
        ->object->toBe('batch')
        ->createdAt->toBe(1711471533)
        ->errors->toBeNull()
        ->status->toBe('completed')
        ->completionWindow->toBe('24h')
        ->requestCounts->toBeArray()->toHaveCount(3)
        ->metadata->toBeArray()->toHaveCount(2)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = BatchResponse::from(batchResource(), meta());

    expect($result['id'])->toBe('batch_abc123');
});

test('to array', function () {
    $result = BatchResponse::from(batchResource(), meta());

    expect($result->toArray())
        ->toBe(batchResource());
});

test('fake', function () {
    $response = BatchResponse::fake();

    expect($response)
        ->id->toBe('batch_abc123');
});

test('fake with override', function () {
    $response = BatchResponse::fake([
        'id' => 'file-1234',
    ]);

    expect($response)
        ->id->toBe('file-1234');
});
