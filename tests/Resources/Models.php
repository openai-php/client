<?php

test('list', function () {
    $client = mockClient('GET', 'models', [], [
        'object' => 'list',
        'data' => [
            model(),
            model(),
        ],
    ]);

    $result = $client->models()->list();

    expect($result)->toBeArray()->toBe([
        'object' => 'list',
        'data' => [
            model(),
            model(),
        ],
    ]);
});

test('retreive', function () {
    $client = mockClient('GET', 'models/da-vince', [], model());

    $result = $client->models()->retrieve('da-vince');

    expect($result)->toBeArray()->toBe(model());
});
