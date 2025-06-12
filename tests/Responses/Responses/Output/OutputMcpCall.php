<?php

use OpenAI\Responses\Responses\Output\OutputMcpCall;

test('from', function () {
    $response = OutputMcpCall::from(outputMcpCall());

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->id->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->serverLabel->toBe('server-name')
        ->name->toBe('Name')
        ->arguments->toBe('')
        ->type->toBe('mcp_call')
        ->approvalRequestId->toBeNull()
        ->error->toBeNull()
        ->output->toBeNull();
});

test('as array accessible', function () {
    $response = OutputMcpCall::from(outputMcpCall());

    expect($response['id'])->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputMcpCall::from(outputMcpCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputMcpCall());
});
