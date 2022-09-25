<?php

test('list', function () {
    $client = mockClient('GET', 'files', [], [
        'object' => 'list',
        'data' => [
            fileResource(),
            fileResource(),
        ],
    ]);

    $result = $client->files()->list();

    expect($result)->toBeArray()->toBe([
        'object' => 'list',
        'data' => [
            fileResource(),
            fileResource(),
        ],
    ]);
});
