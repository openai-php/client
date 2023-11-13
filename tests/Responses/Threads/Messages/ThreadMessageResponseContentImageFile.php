<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentImageFile;

test('from', function () {
    $result = ThreadMessageResponseContentImageFile::from(threadMessageResource()['content'][1]['image_file']);

    expect($result)
        ->fileId->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI');
});

test('as array accessible', function () {
    $result = ThreadMessageResponseContentImageFile::from(threadMessageResource()['content'][1]['image_file']);

    expect($result['file_id'])
        ->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI');
});

test('to array', function () {
    $result = ThreadMessageResponseContentImageFile::from(threadMessageResource()['content'][1]['image_file']);

    expect($result->toArray())
        ->toBe(threadMessageResource()['content'][1]['image_file']);
});
