<?php

use OpenAI\Responses\Embeddings\CreateResponse;
use OpenAI\Responses\Embeddings\CreateResponseEmbedding;

test('from', function () {
    $response = CreateResponse::from(embeddingList());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('list')
        ->embeddings->toBeArray()->toHaveCount(2)
        ->embeddings->each->toBeInstanceOf(CreateResponseEmbedding::class);
});

test('as array accessible', function () {
    $response = CreateResponse::from(embeddingList());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = CreateResponse::from(embeddingList());

    expect($response->toArray())->toBeArray()->toBe(embeddingList());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response['data'][0])
        ->object->toBe('embedding')
        ->embedding->toBe([-0.008906792, -0.013743395]);
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
