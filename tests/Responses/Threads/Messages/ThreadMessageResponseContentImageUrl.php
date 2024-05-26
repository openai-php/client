<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentImageUrl;

test('from', function () {
    $result = ThreadMessageResponseContentImageUrl::from(threadMessageResource()['content'][2]['image_url']);

    expect($result)
        ->fileId->toBe('file-VKxjnFCaSHc4ZELRGKwTMFtI')
        ->detail->toBe('high');
});

test('as array accessible', function () {
    $result = ThreadMessageResponseContentImageUrl::from(threadMessageResource()['content'][2]['image_url']);

    expect($result['file_id'])
        ->toBe('file-VKxjnFCaSHc4ZELRGKwTMFtI')
        ->and($result['detail'])
        ->toBe('high');
});

test('to array', function () {
    $result = ThreadMessageResponseContentImageUrl::from(threadMessageResource()['content'][2]['image_url']);

    expect($result->toArray())
        ->toBe(threadMessageResource()['content'][2]['image_url']);
});
