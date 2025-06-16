<?php

use OpenAI\Responses\Responses\Output\OutputMcpListTools;

test('from', function () {
    $response = OutputMcpListTools::from(outputMcpListTools());

    expect($response)
        ->toBeInstanceOf(OutputMcpListTools::class)
        ->id->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->serverLabel->toBe('server-name')
        ->type->toBe('mcp_list_tools')
        ->tools->toBeArray();
});

test('as array accessible', function () {
    $response = OutputMcpListTools::from(outputMcpListTools());

    expect($response['id'])->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputMcpListTools::from(outputMcpListTools());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputMcpListTools());
});
