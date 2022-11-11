<?php

use OpenAI\Responses\Files\CreateResponse;

test('from', function () {
    $response = CreateResponse::from(fileResource());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune')
        ->status->toBe('succeeded')
        ->statusDetails->toBeNull();
});

test('as array accessible', function () {
    $response = CreateResponse::from(fileResource());

    expect($response['id'])->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('to array', function () {
    $response = CreateResponse::from(fileResource());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fileResource());
});
