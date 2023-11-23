<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileListResponse;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileResponse;

test('from', function () {
    $response = ThreadMessageFileListResponse::from(threadMessageFileListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ThreadMessageFileListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadMessageFileResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ThreadMessageFileListResponse::from(threadMessageFileListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ThreadMessageFileListResponse::from(threadMessageFileListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(threadMessageFileListResource());
});

test('fake', function () {
    $response = ThreadMessageFileListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI');
});

test('fake with override', function () {
    $response = ThreadMessageFileListResponse::fake([
        'data' => [
            [
                'id' => 'file-1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('file-1234');
});
