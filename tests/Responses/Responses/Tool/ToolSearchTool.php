<?php

use OpenAI\Responses\Responses\Tool\ToolSearchTool;

test('from', function () {
    $response = ToolSearchTool::from(toolToolSearch());

    expect($response)
        ->toBeInstanceOf(ToolSearchTool::class)
        ->type->toBe('tool_search')
        ->description->toBe('A tool for searching tools.')
        ->execution->toBe('server')
        ->parameters->toBeArray();
});

test('as array accessible', function () {
    $response = ToolSearchTool::from(toolToolSearch());

    expect($response['type'])->toBe('tool_search');
});

test('to array', function () {
    $response = ToolSearchTool::from(toolToolSearch());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolToolSearch());
});
