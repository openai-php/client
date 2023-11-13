<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextAnnotationFilePath;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextAnnotationFilePathObject;

test('from', function () {
    $result = ThreadMessageResponseContentTextAnnotationFilePathObject::from(threadMessageResource()['content'][0]['text']['annotations'][0]);

    expect($result)
        ->type->toBe('file_path')
        ->text->toBe('sandbox:/mnt/data/shuffled_file.csv')
        ->startIndex->toBe(167)
        ->endIndex->toBe(202)
        ->filePath->toBeInstanceOf(ThreadMessageResponseContentTextAnnotationFilePath::class);
});

test('as array accessible', function () {
    $result = ThreadMessageResponseContentTextAnnotationFilePathObject::from(threadMessageResource()['content'][0]['text']['annotations'][0]);

    expect($result['type'])
        ->toBe('file_path');
});

test('to array', function () {
    $result = ThreadMessageResponseContentTextAnnotationFilePathObject::from(threadMessageResource()['content'][0]['text']['annotations'][0]);

    expect($result->toArray())
        ->toBe(threadMessageResource()['content'][0]['text']['annotations'][0]);
});
