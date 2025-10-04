<?php

use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsFileCitation;

test('from', function () {
    $annotation = outputAnnotationMessage()['content'][0]['annotations'][3];
    $response = OutputMessageContentOutputTextAnnotationsFileCitation::from($annotation);

    expect($response)
        ->toBeInstanceOf(OutputMessageContentOutputTextAnnotationsFileCitation::class)
        ->fileId->toBe('file-8aTRXYAhp5PbDF5R5P9Rky')
        ->filename->toBe('document.pdf')
        ->index->toBe(138)
        ->type->toBe('file_citation');
});

test('from with second file citation', function () {
    $annotation = outputAnnotationMessage()['content'][0]['annotations'][4];
    $response = OutputMessageContentOutputTextAnnotationsFileCitation::from($annotation);

    expect($response)
        ->toBeInstanceOf(OutputMessageContentOutputTextAnnotationsFileCitation::class)
        ->fileId->toBe('file-9cPRXMKyn1BmDT1K9J8Xxa')
        ->filename->toBe('example-file.md')
        ->index->toBe(294)
        ->type->toBe('file_citation');
});

test('as array accessible', function () {
    $annotation = outputAnnotationMessage()['content'][0]['annotations'][3];
    $response = OutputMessageContentOutputTextAnnotationsFileCitation::from($annotation);

    expect($response['file_id'])->toBe('file-8aTRXYAhp5PbDF5R5P9Rky')
        ->and($response['filename'])->toBe('document.pdf')
        ->and($response['index'])->toBe(138)
        ->and($response['type'])->toBe('file_citation');
});

test('to array', function () {
    $annotation = outputAnnotationMessage()['content'][0]['annotations'][3];
    $response = OutputMessageContentOutputTextAnnotationsFileCitation::from($annotation);

    expect($response->toArray())
        ->toBeArray()
        ->toBe($annotation);
});
