<?php

use OpenAI\Responses\Responses\Tool\ProgrammaticToolCallingTool;

test('from', function () {
    $response = ProgrammaticToolCallingTool::from(toolProgrammaticToolCalling());

    expect($response)
        ->toBeInstanceOf(ProgrammaticToolCallingTool::class)
        ->type->toBe('programmatic_tool_calling');
});

test('as array accessible', function () {
    $response = ProgrammaticToolCallingTool::from(toolProgrammaticToolCalling());

    expect($response['type'])->toBe('programmatic_tool_calling');
});

test('to array', function () {
    $response = ProgrammaticToolCallingTool::from(toolProgrammaticToolCalling());

    expect($response->toArray())
        ->toBe(toolProgrammaticToolCalling());
});
