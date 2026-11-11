<?php

use OpenAI\Responses\Responses\Tool\LocalShellTool;

test('from', function () {
    $response = LocalShellTool::from(toolLocalShell());

    expect($response)
        ->toBeInstanceOf(LocalShellTool::class)
        ->type->toBe('local_shell');
});

test('as array accessible', function () {
    $response = LocalShellTool::from(toolLocalShell());

    expect($response['type'])->toBe('local_shell');
});

test('to array', function () {
    $response = LocalShellTool::from(toolLocalShell());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolLocalShell());
});

test('fake', function () {
    $response = LocalShellTool::fake();

    expect($response)
        ->toBeInstanceOf(LocalShellTool::class)
        ->type->toBe('local_shell');
});
