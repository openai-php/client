<?php

use OpenAI\Responses\Responses\Input\FunctionToolCallOutput;

test('from', function () {
    $response = FunctionToolCallOutput::from(functionToolCallOutputItem());

    expect($response)
        ->toBeInstanceOf(FunctionToolCallOutput::class)
        ->type->toBe('function_call_output')
        ->callId->toBe('call_inventory_123')
        ->caller->callerId->toBe('call_prog_123');
});

it('to array', function () {
    $response = FunctionToolCallOutput::from(functionToolCallOutputItem());

    expect($response->toArray())->toBe(functionToolCallOutputItem());
});
