<?php

use OpenAI\Responses\Responses\Tool\FunctionTool;

test('from with programmatic tool calling fields', function () {
    $response = FunctionTool::from(toolFunctionProgrammatic());

    expect($response)
        ->toBeInstanceOf(FunctionTool::class)
        ->allowedCallers->toBe(['programmatic'])
        ->outputSchema->toBe(toolFunctionProgrammatic()['output_schema']);
});

test('to array with programmatic tool calling fields', function () {
    $response = FunctionTool::from(toolFunctionProgrammatic());

    expect($response->toArray())
        ->toBe(toolFunctionProgrammatic());
});
