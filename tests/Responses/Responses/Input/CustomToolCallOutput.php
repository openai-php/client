<?php

use OpenAI\Responses\Responses\Input\CustomToolCallOutput;

test('from', function () {
    $response = CustomToolCallOutput::from(customToolCallOutputItem());

    expect($response)
        ->toBeInstanceOf(CustomToolCallOutput::class)
        ->type->toBe('custom_tool_call_output')
        ->id->toBe('cto_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->output->toBe('custom-output');
});

it('is array accessible', function () {
    $response = CustomToolCallOutput::from(customToolCallOutputItem());

    expect($response['output'])->toBe('custom-output');
});

it('to array', function () {
    $response = CustomToolCallOutput::from(customToolCallOutputItem());

    expect($response->toArray())
        ->toBe(customToolCallOutputItem());
});
