<?php

use OpenAI\Responses\Files\DeleteResponse;

test('from', function () {
    $result = DeleteResponse::from(fileDeleteResource());

    expect($result)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->deleted->toBe(true);
});

test('as array accessible', function () {
    $result = DeleteResponse::from(fileDeleteResource());

    expect($result['id'])->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('to array', function () {
    $result = DeleteResponse::from(fileDeleteResource());

    expect($result->toArray())
        ->toBe(fileDeleteResource());
});
