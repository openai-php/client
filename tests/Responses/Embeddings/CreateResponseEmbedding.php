<?php

use OpenAI\Responses\Embeddings\CreateResponseEmbedding;

test('from', function () {
    $result = CreateResponseEmbedding::from(embedding());

    expect($result)
        ->object->toBe('embedding')
        ->index->toBe(0)
        ->embedding->toBeArray()->toBe([
            -0.008906792,
            -0.013743395,
            0.009874112,
        ]);
});

test('to array', function () {
    $result = CreateResponseEmbedding::from(embedding());

    expect($result->toArray())
        ->toBe(embedding());
});
