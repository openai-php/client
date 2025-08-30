<?php

use OpenAI\Responses\Responses\Tool\McpToolNamesFilter;
use OpenAI\Responses\Responses\Tool\RemoteMcpTool;

test('from', function () {
    $response = RemoteMcpTool::from(toolRemoteMcp());

    expect($response)
        ->toBeInstanceOf(RemoteMcpTool::class)
        ->type->toBe('mcp')
        ->serverLabel->toBe('My test MCP server')
        ->serverUrl->toBe('https://server.example.com/mcp');
});

test('from results', function () {
    $response = RemoteMcpTool::from(toolRemoteMcp());

    expect($response)
        ->toBeInstanceOf(RemoteMcpTool::class)
        ->type->toBe('mcp');
});

test('from connector results', function () {
    $response = RemoteMcpTool::from(toolConnectorMcp());

    expect($response)
        ->toBeInstanceOf(RemoteMcpTool::class)
        ->connectorId->toBe('connector_dropbox')
        ->serverUrl->toBeNull()
        ->serverLabel->toBe('Dropbox');
});

test('from object as require_approval', function () {
    $payload = toolRemoteMcp();
    $payload['require_approval'] = [
        'never' => [
            'tool_names' => ['ask_question'],
        ],
    ];
    $response = RemoteMcpTool::from($payload);

    expect($response)
        ->toBeInstanceOf(RemoteMcpTool::class)
        ->requireApproval->toBeArray();
});

test('from object as specific approved tools', function () {
    $response = RemoteMcpTool::from(toolRemoveMcpRequireApproval());

    expect($response)
        ->toBeInstanceOf(RemoteMcpTool::class)
        ->requireApproval->toBeArray();
});

test('from object as allowed_tools', function () {
    $payload = toolRemoteMcp();
    $payload['allowed_tools'] = [
        'tool_names' => ['ask_question'],
    ];
    $response = RemoteMcpTool::from($payload);

    expect($response)
        ->toBeInstanceOf(RemoteMcpTool::class)
        ->allowedTools->toBeInstanceOf(McpToolNamesFilter::class);
});

test('as array accessible', function () {
    $response = RemoteMcpTool::from(toolRemoteMcp());

    expect($response['type'])->toBe('mcp');
});

test('to array', function () {
    $response = RemoteMcpTool::from(toolRemoteMcp());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolRemoteMcp());
});
