<?php

use OpenAI\Responses\Responses\Output\OutputCompaction;

test('from', function () {
    $response = OutputCompaction::from(outputCompaction());

    expect($response)
        ->toBeInstanceOf(OutputCompaction::class)
        ->id->toBe('cmp_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->encryptedContent->toBe('encrypted_string_value')
        ->type->toBe('compaction')
        ->createdBy->toBe('user_123');
});

test('from without created_by', function () {
    $attributes = outputCompaction();
    unset($attributes['created_by']);

    $response = OutputCompaction::from($attributes);

    expect($response)
        ->toBeInstanceOf(OutputCompaction::class)
        ->createdBy->toBeNull();
});

test('as array accessible', function () {
    $response = OutputCompaction::from(outputCompaction());

    expect($response['id'])->toBe('cmp_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputCompaction::from(outputCompaction());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputCompaction());
});
