<?php

use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsContainerFile;

test('from', function () {
    $annotation = outputAnnotationMessage()['content'][0]['annotations'][5];
    $response = OutputMessageContentOutputTextAnnotationsContainerFile::from($annotation);

    expect($response)
        ->toBeInstanceOf(OutputMessageContentOutputTextAnnotationsContainerFile::class)
        ->fileId->toBe('cfile_15vdn2c43dec8191afde1f1fc40avec6')
        ->filename->toBe('image.png')
        ->startIndex->toBe(133)
        ->endIndex->toBe(166)
        ->type->toBe('container_file_citation')
        ->containerId->toBe('cntr_61vcf2b258d88128b3fc109db6fv61e406ebfd5bc0cbcbce');
});

test('as array accessible', function () {
    $annotation = outputAnnotationMessage()['content'][0]['annotations'][5];
    $response = OutputMessageContentOutputTextAnnotationsContainerFile::from($annotation);

    expect($response['file_id'])->toBe('cfile_15vdn2c43dec8191afde1f1fc40avec6')
        ->and($response['filename'])->toBe('image.png')
        ->and($response['start_index'])->toBe(133)
        ->and($response['end_index'])->toBe(166)
        ->and($response['type'])->toBe('container_file_citation')
        ->and($response['container_id'])->toBe('cntr_61vcf2b258d88128b3fc109db6fv61e406ebfd5bc0cbcbce');
});

test('to array', function () {
    $annotation = outputAnnotationMessage()['content'][0]['annotations'][5];
    $response = OutputMessageContentOutputTextAnnotationsContainerFile::from($annotation);

    expect($response->toArray())
        ->toBeArray()
        ->toBe($annotation);
});
