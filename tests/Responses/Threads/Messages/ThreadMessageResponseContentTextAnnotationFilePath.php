<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextAnnotationFilePath;

test('from', function () {
    $result = ThreadMessageResponseContentTextAnnotationFilePath::from(threadMessageResource()['content'][0]['text']['annotations'][0]['file_path']);

    expect($result)
        ->fileId->toBe('file-oSgJAzAnnQkVB3u7yCoE9CBe');
});

test('as array accessible', function () {
    $result = ThreadMessageResponseContentTextAnnotationFilePath::from(threadMessageResource()['content'][0]['text']['annotations'][0]['file_path']);

    expect($result['file_id'])
        ->toBe('file-oSgJAzAnnQkVB3u7yCoE9CBe');
});

test('to array', function () {
    $result = ThreadMessageResponseContentTextAnnotationFilePath::from(threadMessageResource()['content'][0]['text']['annotations'][0]['file_path']);

    expect($result->toArray())
        ->toBe(threadMessageResource()['content'][0]['text']['annotations'][0]['file_path']);
});
