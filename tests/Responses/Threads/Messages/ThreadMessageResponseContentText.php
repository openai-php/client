<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentText;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextAnnotationFilePathObject;

test('from', function () {
    $result = ThreadMessageResponseContentText::from(threadMessageResource()['content'][0]['text']);

    expect($result->value)
        ->toBe('How does AI work? Explain it in simple terms.')
        ->and($result)
        ->annotations->toBeArray()
        ->annotations->{0}->toBeInstanceOf(ThreadMessageResponseContentTextAnnotationFilePathObject::class);
});

test('as array accessible', function () {
    $result = ThreadMessageResponseContentText::from(threadMessageResource()['content'][0]['text']);

    expect($result['value'])
        ->toBe('How does AI work? Explain it in simple terms.');
});

test('to array', function () {
    $result = ThreadMessageResponseContentText::from(threadMessageResource()['content'][0]['text']);

    expect($result->toArray())
        ->toBe(threadMessageResource()['content'][0]['text']);
});
