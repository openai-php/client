<?php

use OpenAI\Responses\Embeddings\CreateResponseUsage;

test('from', function () {
    $result = CreateResponseUsage::from(embeddingList()['usage']);

    expect($result)
        ->promptTokens->toBe(8)
        ->totalTokens->toBe(8);
});

test('to array', function () {
    $result = CreateResponseUsage::from(embeddingList()['usage']);

    expect($result->toArray())
        ->toBe(embeddingList()['usage']);
});
