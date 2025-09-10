<?php

use OpenAI\Responses\Responses\Input\McpApprovalResponse;

test('from', function () {
    $response = McpApprovalResponse::from(mcpApprovalResponseItem());

    expect($response)
        ->toBeInstanceOf(McpApprovalResponse::class)
        ->type->toBe('mcp_approval_response')
        ->id->toBe('mar_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->approvalRequestId->toBe('apr_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->approved->toBeTrue()
        ->reason->toBeNull();
});

it('is array accessible', function () {
    $response = McpApprovalResponse::from(mcpApprovalResponseItem());

    expect($response['approval_request_id'])->toBe('apr_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

it('to array', function () {
    $response = McpApprovalResponse::from(mcpApprovalResponseItem());

    expect($response->toArray())
        ->toBe([
            'type' => 'mcp_approval_response',
            'approval_request_id' => 'apr_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
            'approve' => true,
            'id' => 'mar_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
            'reason' => null,
        ]);
});
