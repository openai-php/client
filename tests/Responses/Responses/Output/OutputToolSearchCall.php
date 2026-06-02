<?php

use OpenAI\Responses\Responses\Output\OutputToolSearchCall;

test('from', function () {
    $response = OutputToolSearchCall::from(outputToolSearchCall());

    expect($response)
        ->toBeInstanceOf(OutputToolSearchCall::class)
        ->id->toBe('tsc_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->arguments->toBeArray()
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->execution->toBe('server')
        ->status->toBe('completed')
        ->type->toBe('tool_search_call')
        ->createdBy->toBe('user_123');
});

test('as array accessible', function () {
    $response = OutputToolSearchCall::from(outputToolSearchCall());

    expect($response['id'])->toBe('tsc_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputToolSearchCall::from(outputToolSearchCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputToolSearchCall());
});
