<?php

use OpenAI\Responses\Files\RetrieveResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = RetrieveResponse::from(fileResource(), meta());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from with status error', function () {
    $result = RetrieveResponse::from(fileWithErrorStatusResource(), meta());

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('file-OGHjVIyNB7svNc6vaUXNgR87')
        ->object->toBe('file')
        ->bytes->toBe(181023)
        ->createdAt->toBe(1678253244)
        ->filename->toBe('mydata_corrupt.jsonl')
        ->purpose->toBe('fine-tune')
        ->status->toBe('error')
        ->statusDetails->toBe("Invalid file format. Example 1273 cannot be parsed. Error: line contains invalid json: Expecting ',' delimiter: line 1 column 79 (char 78) (line 1273)")
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = RetrieveResponse::from(fileResource(), meta());

    expect($result['id'])->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('to array', function () {
    $result = RetrieveResponse::from(fileResource(), meta());

    expect($result->toArray())
        ->toBe(fileResource());
});

test('fake', function () {
    $response = RetrieveResponse::fake();

    expect($response)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3');
});

test('fake with override', function () {
    $response = RetrieveResponse::fake([
        'id' => 'file-1234',
    ]);

    expect($response)
        ->id->toBe('file-1234');
});
