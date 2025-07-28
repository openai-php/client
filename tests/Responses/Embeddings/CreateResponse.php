<?php

use OpenAI\Responses\Embeddings\CreateResponse;
use OpenAI\Responses\Embeddings\CreateResponseEmbedding;
use OpenAI\Responses\Embeddings\CreateResponseUsage;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = CreateResponse::from(embeddingList(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('list')
        ->model->toBe('text-embedding-3-small')
        ->embeddings->toBeArray()->toHaveCount(2)
        ->embeddings->each->toBeInstanceOf(CreateResponseEmbedding::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from without usage', function () {
    $response = CreateResponse::from(embeddingListWithoutUsage(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('list')
        ->model->toBe('text-embedding-3-small')
        ->embeddings->toBeArray()->toHaveCount(2)
        ->embeddings->each->toBeInstanceOf(CreateResponseEmbedding::class)
        ->usage->toBeNull()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from without model', function () {
    $response = CreateResponse::from(embeddingListWithoutModel(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('list')
        ->model->toBeNull()
        ->embeddings->toBeArray()->toHaveCount(2)
        ->embeddings->each->toBeInstanceOf(CreateResponseEmbedding::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = CreateResponse::from(embeddingList(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = CreateResponse::from(embeddingList(), meta());

    expect($response->toArray())->toBeArray()->toBe(embeddingList());
});

test('to array without model', function () {
    $response = CreateResponse::from(embeddingListWithoutModel(), meta());

    expect($response->toArray())->toBeArray()->toBe(embeddingListWithoutModel());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response['data'][0])
        ->object->toBe('embedding');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'data' => [
            [
                'embedding' => [
                    0.1234,
                    0.5678,
                    0.9876,
                ],
            ],
            [
                'object' => 'embedding',
                'index' => 1,
                'embedding' => [
                    -0.1234,
                    -0.5678,
                    -0.9876,
                ],
            ],
        ],
    ]);

    expect($response->embeddings[0])
        ->embedding->toBe([0.1234, 0.5678, 0.9876])
        ->and($response->embeddings[1])
        ->object->toBe('embedding')
        ->index->toBe(1)
        ->embedding->toBe([-0.1234, -0.5678, -0.9876]);
});
