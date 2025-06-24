<?php

use OpenAI\Responses\Responses\Output\OutputMcpCall;

require_once __DIR__.'/../../../Fixtures/Responses.php';

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

test('from with error as direct content array', function () {
    $errorResponse = [
        'id' => 'mcp_error_123',
        'server_label' => 'test-server',
        'type' => 'mcp_call',
        'arguments' => '{"foo": "bar"}',
        'name' => 'testFunction',
        'approval_request_id' => null,
        'error' => [
            [
                'type' => 'text',
                'text' => 'Error: Function execution failed',
            ],
        ],
        'output' => null,
    ];

    $response = OutputMcpCall::from($errorResponse);

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->id->toBe('mcp_error_123')
        ->serverLabel->toBe('test-server')
        ->name->toBe('testFunction')
        ->arguments->toBe('{"foo": "bar"}')
        ->type->toBe('mcp_call')
        ->approvalRequestId->toBeNull()
        ->error->toBe('Error: Function execution failed')
        ->output->toBeNull();
});

test('from with error as object with content array', function () {
    $errorResponse = [
        'id' => 'mcp_error_456',
        'server_label' => 'test-server',
        'type' => 'mcp_call',
        'arguments' => '{"foo": "bar"}',
        'name' => 'testFunction',
        'approval_request_id' => null,
        'error' => [
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Error: Permission denied',
                ],
            ],
        ],
        'output' => null,
    ];

    $response = OutputMcpCall::from($errorResponse);

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->error->toBe('Error: Permission denied');
});

test('from with error as string', function () {
    $errorResponse = [
        'id' => 'string_error_789',
        'server_label' => 'test-server',
        'type' => 'mcp_call',
        'arguments' => '{"foo": "bar"}',
        'name' => 'testFunction',
        'approval_request_id' => null,
        'error' => 'Simple error message',
        'output' => null,
    ];

    $response = OutputMcpCall::from($errorResponse);

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->error->toBe('Simple error message');
});

test('from with unparseable error array', function () {
    $errorResponse = [
        'id' => 'complex_error',
        'server_label' => 'test-server',
        'type' => 'mcp_call',
        'arguments' => '{}',
        'name' => 'testFunction',
        'approval_request_id' => null,
        'error' => [
            'some' => 'complex',
            'nested' => ['error' => 'structure'],
        ],
        'output' => null,
    ];

    $response = OutputMcpCall::from($errorResponse);

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->error->toBe('{"some":"complex","nested":{"error":"structure"}}');
});
