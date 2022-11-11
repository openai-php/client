<?php

use OpenAI\Responses\FineTunes\RetrieveResponseFile;

test('from', function () {
    $result = RetrieveResponseFile::from(fileResource());

    expect($result)
        ->toBeInstanceOf(RetrieveResponseFile::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune')
        ->status->toBe('succeeded')
        ->statusDetails->toBeNull();
});

test('to array', function () {
    $result = RetrieveResponseFile::from(fileResource());

    expect($result->toArray())
        ->toBe(fileResource());
});
