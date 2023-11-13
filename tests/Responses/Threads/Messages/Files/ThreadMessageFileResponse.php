<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileResponse;

test('from', function () {
    $result = ThreadMessageFileResponse::from(threadMessageFileResource(), meta());

    expect($result)
        ->id->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI')
        ->object->toBe('thread.message.file')
        ->createdAt->toBe(1699624660)
        ->messageId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ThreadMessageFileResponse::from(threadMessageFileResource(), meta());

    expect($result['id'])
        ->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI');
});

test('to array', function () {
    $result = ThreadMessageFileResponse::from(threadMessageFileResource(), meta());

    expect($result->toArray())
        ->toBe(threadMessageFileResource());
});

test('fake', function () {
    $response = ThreadMessageFileResponse::fake();

    expect($response)
        ->id->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI');
});

test('fake with override', function () {
    $response = ThreadMessageFileResponse::fake([
        'id' => 'file-1234',
    ]);

    expect($response)
        ->id->toBe('file-1234');
});
