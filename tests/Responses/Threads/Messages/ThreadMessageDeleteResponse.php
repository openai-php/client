<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Messages\ThreadMessageDeleteResponse;

test('from', function () {
    $result = ThreadMessageDeleteResponse::from(threadMessageDeleteResource(), meta());

    expect($result)
        ->id->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->object->toBe('thread.message.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ThreadMessageDeleteResponse::from(threadMessageDeleteResource(), meta());

    expect($result['id'])
        ->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ');
});

test('to array', function () {
    $result = ThreadMessageDeleteResponse::from(threadMessageDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(threadMessageDeleteResource());
});

test('fake', function () {
    $response = ThreadMessageDeleteResponse::fake();

    expect($response)
        ->id->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = ThreadMessageDeleteResponse::fake([
        'id' => 'msg_1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('msg_1234')
        ->deleted->toBe(false);
});
