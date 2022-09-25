<?php

test('create', function () {
    $client = mockClient('POST', 'completions', [
        'model' => 'da-vince',
        'prompt' => 'hi',
    ], completion());

    $result = $client->completions()->create([
        'model' => 'da-vince',
        'prompt' => 'hi',
    ]);

    expect($result)->toBeArray()->toBe(completion());
});
