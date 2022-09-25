<?php

test('create', function () {
    $client = mockClient('POST', 'embeddings', [
        'model' => 'text-similarity-babbage-001',
        'input' => 'The food was delicious and the waiter...',
    ], [
        'object' => 'list',
        'data' => [
            embedding(),
            embedding(),
        ],
    ]);

    $result = $client->embeddings()->create([
        'model' => 'text-similarity-babbage-001',
        'input' => 'The food was delicious and the waiter...',
    ]);

    expect($result)->toBeArray()->toBe([
        'object' => 'list',
        'data' => [
            embedding(),
            embedding(),
        ],
    ]);
});
