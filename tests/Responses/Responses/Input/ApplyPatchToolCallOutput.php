<?php

use OpenAI\Responses\Responses\Input\ApplyPatchToolCallOutput;

test('from', function () {
    $response = ApplyPatchToolCallOutput::from(applyPatchToolCallOutputItem());

    expect($response)
        ->toBeInstanceOf(ApplyPatchToolCallOutput::class)
        ->id->toBe('apco_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->status->toBe('failed')
        ->type->toBe('apply_patch_call_output')
        ->caller->toBe([
            'caller_id' => 'prog_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
            'type' => 'program',
        ])
        ->createdBy->toBe('prog_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->output->toBe('Could not apply patch: invalid context.');
});

test('from without optional output metadata', function () {
    $response = ApplyPatchToolCallOutput::from([
        'id' => 'apco_123',
        'call_id' => 'call_123',
        'status' => 'completed',
        'type' => 'apply_patch_call_output',
    ]);

    expect($response)
        ->caller->toBeNull()
        ->createdBy->toBeNull()
        ->output->toBeNull();
});

test('as array accessible', function () {
    $response = ApplyPatchToolCallOutput::from(applyPatchToolCallOutputItem());

    expect($response['status'])->toBe('failed');
});

test('to array', function () {
    $response = ApplyPatchToolCallOutput::from(applyPatchToolCallOutputItem());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(applyPatchToolCallOutputItem());
});
