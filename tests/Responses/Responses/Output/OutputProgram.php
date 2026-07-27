<?php

use OpenAI\Responses\Responses\Output\OutputProgram;

test('from', function () {
    $response = OutputProgram::from(outputProgram());

    expect($response)
        ->toBeInstanceOf(OutputProgram::class)
        ->type->toBe('program')
        ->id->toBe('prog_123')
        ->callId->toBe('call_prog_123')
        ->code->toBe(outputProgram()['code'])
        ->fingerprint->toBe('opaque_replay_state');
});

test('as array accessible', function () {
    $response = OutputProgram::from(outputProgram());

    expect($response['call_id'])->toBe('call_prog_123');
});

test('to array', function () {
    $response = OutputProgram::from(outputProgram());

    expect($response->toArray())
        ->toBe(outputProgram());
});
