<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\InputTokenCountResponse;

test('from', function () {
    $result = InputTokenCountResponse::from(inputTokenCountResource(), meta());

    expect($result)
        ->object->toBe('response.input_tokens')
        ->inputTokens->toBe(11)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = InputTokenCountResponse::from(inputTokenCountResource(), meta());

    expect($result['input_tokens'])
        ->toBe(11);
});

test('to array', function () {
    $result = InputTokenCountResponse::from(inputTokenCountResource(), meta());

    expect($result->toArray())
        ->toBe(inputTokenCountResource());
});

test('fake', function () {
    $response = InputTokenCountResponse::fake();

    expect($response)
        ->object->toBe('response.input_tokens')
        ->inputTokens->toBe(11);
});

test('fake with override', function () {
    $response = InputTokenCountResponse::fake([
        'input_tokens' => 42,
    ]);

    expect($response)
        ->inputTokens->toBe(42);
});
