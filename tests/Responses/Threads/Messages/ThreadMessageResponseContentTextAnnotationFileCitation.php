<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextAnnotationFileCitation;

test('from', function () {
    $result = ThreadMessageResponseContentTextAnnotationFileCitation::from(threadMessageResource()['content'][0]['text']['annotations'][1]['file_citation']);

    expect($result)
        ->fileId->toBe('file-oSgJAzAnnQkVB3u7yCoE9CBe')
        ->quote->toBe('To be or not to be, that is the question.');
});

test('as array accessible', function () {
    $result = ThreadMessageResponseContentTextAnnotationFileCitation::from(threadMessageResource()['content'][0]['text']['annotations'][1]['file_citation']);

    expect($result['file_id'])
        ->toBe('file-oSgJAzAnnQkVB3u7yCoE9CBe');
});

test('to array', function () {
    $result = ThreadMessageResponseContentTextAnnotationFileCitation::from(threadMessageResource()['content'][0]['text']['annotations'][1]['file_citation']);

    expect($result->toArray())
        ->toBe(threadMessageResource()['content'][0]['text']['annotations'][1]['file_citation']);
});
