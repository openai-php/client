<?php

use OpenAI\Responses\Batches\BatchListResponse;
use OpenAI\Responses\Batches\BatchResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = BatchListResponse::from(batchListResource(), meta());

    expect($response)
        ->toBeInstanceOf(BatchListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(4)
        ->data->each->toBeInstanceOf(BatchResponse::class)
        ->firstId->toBe('batch_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->lastId->toBe('batch_y49lAdZDiaQUxEBR6zrG846Q')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = BatchListResponse::from(batchListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = BatchListResponse::from(batchListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(batchListResource());
});

test('fake', function () {
    $response = BatchListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('batch_abc123');
});

test('fake with override', function () {
    $response = BatchListResponse::fake([
        'data' => [
            [
                'id' => 'batch_abc123ccccc',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('batch_abc123ccccc');
});
