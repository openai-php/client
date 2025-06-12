<?php

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
