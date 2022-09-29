<?php

test('create', function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], moderationResource());

    $result = $client->moderations()->create([
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ]);

    expect($result)->toBeArray()->toBe(moderationResource());
});
