<?php

use OpenAI\Responses\Responses\Output\OutputMcpApprovalRequest;

test('from', function () {
    $response = OutputMcpApprovalRequest::from(outputMcpApprovalRequest());

    expect($response)
        ->toBeInstanceOf(OutputMcpApprovalRequest::class)
        ->id->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->serverLabel->toBe('server-name')
        ->name->toBe('Name')
        ->arguments->toBe('');
});

test('as array accessible', function () {
    $response = OutputMcpApprovalRequest::from(outputMcpApprovalRequest());

    expect($response['id'])->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputMcpApprovalRequest::from(outputMcpApprovalRequest());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputMcpApprovalRequest());
});
