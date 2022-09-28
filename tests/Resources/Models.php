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

test('delete fine tuned model', function () {
    $client = mockClient('DELETE', 'models/curie:ft-acmeco-2021-03-03-21-44-20', [], fineTunedModelDeleteResource());

    $result = $client->models()->delete('curie:ft-acmeco-2021-03-03-21-44-20');

    expect($result)->toBeArray()->toBe(fineTunedModelDeleteResource());
});
