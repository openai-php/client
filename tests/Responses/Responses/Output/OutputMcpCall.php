<?php

use OpenAI\Responses\Responses\GenericResponseError;
use OpenAI\Responses\Responses\McpGenericResponseError;
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

test('from error as http object', function () {
    $response = OutputMcpCall::from(outputMcpErrorCallObject());

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->error->toBeInstanceOf(GenericResponseError::class)
        ->and($response->error)
        ->code->toBe('401')
        ->message->toBe('Unauthorized');
});

test('from error as string', function () {
    $response = OutputMcpCall::from(outputMcpErrorCallString());

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->error->toBeInstanceOf(GenericResponseError::class)
        ->and($response->error)
        ->code->toBe('unknown_error')
        ->message->toBe('Missing or invalid authorization token.');

});

test('from error as mcp tool execution error', function () {
    $response = OutputMcpCall::from(outputMcpErrorCallToolExecution());

    expect($response)
        ->toBeInstanceOf(OutputMcpCall::class)
        ->id->toBe('mcp_68ae0539ede081a096e9cc4526aadc8200b5e200d643ebad')
        ->type->toBe('mcp_call')
        ->approvalRequestId->toBeNull()
        ->arguments->toBe('{"value":"test"}')
        ->name->toBe('deploy-html')
        ->output->toBeNull()
        ->serverLabel->toBe('deploy-html')
        ->error->toBeInstanceOf(McpGenericResponseError::class)
        ->and($response->error)
        ->type->toBe('mcp_tool_execution_error')
        ->content->toBeArray();
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
