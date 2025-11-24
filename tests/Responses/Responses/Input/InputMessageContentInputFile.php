<?php

use OpenAI\Responses\Responses\Input\InputMessageContentInputFile;

test('from', function () {
    $response = InputMessageContentInputFile::from(InputMessageContentInputFileItem());

    expect($response)
        ->toBeInstanceOf(InputMessageContentInputFile::class)
        ->type->toBe('input_file')
        ->fileData->toBe('data:application/pdf;base64,JVBERi0xLjUKJY8KMTgxIDAgb2JqCjw8IC9GaWx0ZXIgL0ZsYXRlRGVjb2RlIC9MZW5ndGggMT...')
        ->fileId->toBe('file_0d1b41da7cb4903a0069235a5089408196a847a8f3e7b4fb1c')
        ->filename->toBe('file.pdf');
});

it('is array accessible', function () {
    $response = InputMessageContentInputFile::from(InputMessageContentInputFileItem());

    expect($response['file_id'])->toBe('file_0d1b41da7cb4903a0069235a5089408196a847a8f3e7b4fb1c');
});

it('to array', function () {
    $response = InputMessageContentInputFile::from(InputMessageContentInputFileItem());

    expect($response->toArray())
        ->toBe([
            'type' => 'input_file',
            'file_data' => 'data:application/pdf;base64,JVBERi0xLjUKJY8KMTgxIDAgb2JqCjw8IC9GaWx0ZXIgL0ZsYXRlRGVjb2RlIC9MZW5ndGggMT...',
            'file_id' => 'file_0d1b41da7cb4903a0069235a5089408196a847a8f3e7b4fb1c',
            'filename' => 'file.pdf',
        ]);
});

test('from (missing or null)', function () {
    $response = InputMessageContentInputFile::from(InputMessageContentInputFileItemMissingOrNull());

    expect($response)
        ->toBeInstanceOf(InputMessageContentInputFile::class)
        ->type->toBe('input_file')
        ->fileData->toBeNull()
        ->fileId->toBeNull()
        ->filename->toBe('file.pdf');
});

it('is array accessible (missing or null)', function () {
    $response = InputMessageContentInputFile::from(InputMessageContentInputFileItemMissingOrNull());

    expect($response['file_id'])->toBeNull();
});

it('to array (missing or null)', function () {
    $response = InputMessageContentInputFile::from(InputMessageContentInputFileItemMissingOrNull());

    expect($response->toArray())
        ->toBe([
            'type' => 'input_file',
            'file_data' => null,
            'file_id' => null,
            'filename' => 'file.pdf',
        ]);
});
