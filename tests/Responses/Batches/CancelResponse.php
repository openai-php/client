<?php

use OpenAI\Responses\Batches\BatchResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = BatchResponse::from(batchResource(), meta());

    expect($result)
        ->id->toBe('batch_abc123')
        ->object->toBe('batch')
        ->errors->toBeNull()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = BatchResponse::from(batchResource(), meta());

    expect($result['id'])->toBe('batch_abc123');
});

test('to array', function () {
    $result = BatchResponse::from(batchResource(), meta());

    expect($result->toArray())
        ->toBe(batchResource());
});

test('fake', function () {
    $response = BatchResponse::fake();

    expect($response)
        ->id->toBe('batch_abc123')
        ->errors->toBeNull();
});

test('fake with override', function () {

    $errors = [
        'test' => '123',
    ];

    $response = BatchResponse::fake([
        'id' => 'batch_tester',
        'errors' => $errors,
    ]);

    expect($response)
        ->id->toBe('batch_tester')
        ->errors->toBe($errors);
});
