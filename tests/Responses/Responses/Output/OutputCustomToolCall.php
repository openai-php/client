<?php

use OpenAI\Responses\Responses\Output\OutputCustomToolCall;

it('can parse custom tool call output', function () {
    $response = OutputCustomToolCall::from(outputCustomToolCall());

    expect($response)
        ->toBeInstanceOf(OutputCustomToolCall::class)
        ->type->toBe('custom_tool_call')
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->input->toBe('ls -l')
        ->name->toBe('my_custom_tool')
        ->id->toBe('ct_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});
