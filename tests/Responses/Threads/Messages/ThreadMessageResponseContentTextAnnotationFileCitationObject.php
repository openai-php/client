<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextAnnotationFileCitation;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextAnnotationFileCitationObject;

test('from', function () {
    $result = ThreadMessageResponseContentTextAnnotationFileCitationObject::from(threadMessageResource()['content'][0]['text']['annotations'][1]);

    expect($result)
        ->type->toBe('file_citation')
        ->text->toBe('The content to replace.')
        ->startIndex->toBe(23)
        ->endIndex->toBe(25)
        ->fileCitation->toBeInstanceOf(ThreadMessageResponseContentTextAnnotationFileCitation::class);
});

test('as array accessible', function () {
    $result = ThreadMessageResponseContentTextAnnotationFileCitationObject::from(threadMessageResource()['content'][0]['text']['annotations'][1]);

    expect($result['type'])
        ->toBe('file_citation');
});

test('to array', function () {
    $result = ThreadMessageResponseContentTextAnnotationFileCitationObject::from(threadMessageResource()['content'][0]['text']['annotations'][1]);

    expect($result->toArray())
        ->toBe(threadMessageResource()['content'][0]['text']['annotations'][1]);
});
