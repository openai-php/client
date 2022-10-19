<?php

use OpenAI\Responses\Files\RetrieveResponse;

test('from', function () {
    $result = RetrieveResponse::from(fileResource());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune');
});

test('as array accessible', function () {
    $result = RetrieveResponse::from(fileResource());

    expect($result['id'])->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('to array', function () {
    $result = RetrieveResponse::from(fileResource());

    expect($result->toArray())
        ->toBe(fileResource());
});
