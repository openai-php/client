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

test('retrieve', function () {
    $client = mockClient('GET', 'files/file-XjGxS3KTG0uNmNOK362iJua3', [], fileResource());

    $result = $client->files()->retrieve('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)->toBeArray()->toBe(fileResource());
});

test('download', function () {
    $client = mockContentClient('GET', 'files/file-XjGxS3KTG0uNmNOK362iJua3/content', [], fileContentResource());

    $result = $client->files()->download('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)->toBeString()->toBe(fileContentResource());
});

test('upload', function () {
    $client = mockClient('POST', 'files', [
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ], fileResource());

    $result = $client->files()->upload([
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ]);

    expect($result)->toBeArray()->toBe(fileResource());
});

test('delete', function () {
    $client = mockClient('DELETE', 'files/file-XjGxS3KTG0uNmNOK362iJua3', [], fileDeleteResource());

    $result = $client->files()->delete('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)->toBeArray()->toBe(fileDeleteResource());
});
