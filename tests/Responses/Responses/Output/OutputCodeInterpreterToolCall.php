<?php

use OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;

test('from', function () {
    $response = OutputCodeInterpreterToolCall::from(outputCodeInterpreterToolCall());

    expect($response)
        ->toBeInstanceOf(OutputCodeInterpreterToolCall::class)
        ->id->toBe('ci_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->status->toBe('completed')
        ->type->toBe('code_interpreter_call')
        ->code->toBe('print("Hello, World!")')
        ->containerId->toBe('container_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->results->toBeArray()
        ->results->toHaveCount(2);
});

test('as array accessible', function () {
    $response = OutputCodeInterpreterToolCall::from(outputCodeInterpreterToolCall());

    expect($response['id'])->toBe('ci_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputCodeInterpreterToolCall::from(outputCodeInterpreterToolCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(OutputCodeInterpreterToolCall());
});
