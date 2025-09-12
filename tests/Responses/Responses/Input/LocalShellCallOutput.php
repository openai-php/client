<?php

use OpenAI\Responses\Responses\Input\LocalShellCallOutput;

test('from', function () {
    $response = LocalShellCallOutput::from(localShellCallOutputItem());

    expect($response)
        ->toBeInstanceOf(LocalShellCallOutput::class)
        ->type->toBe('local_shell_call_output')
        ->id->toBe('lco_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->output->toBe('hello')
        ->status->toBe('completed');
});

it('is array accessible', function () {
    $response = LocalShellCallOutput::from(localShellCallOutputItem());

    expect($response['output'])->toBe('hello');
});

it('to array', function () {
    $response = LocalShellCallOutput::from(localShellCallOutputItem());

    expect($response->toArray())
        ->toBe(localShellCallOutputItem());
});
