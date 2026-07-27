<?php

use OpenAI\Responses\Responses\Output\OutputProgramOutput;

test('from', function () {
    $response = OutputProgramOutput::from(outputProgramOutput());

    expect($response)
        ->toBeInstanceOf(OutputProgramOutput::class)
        ->type->toBe('program_output')
        ->id->toBe('prog_out_123')
        ->callId->toBe('call_prog_123')
        ->result->toBe(outputProgramOutput()['result'])
        ->status->toBe('completed');
});

test('as array accessible', function () {
    $response = OutputProgramOutput::from(outputProgramOutput());

    expect($response['result'])->toBe(outputProgramOutput()['result']);
});

test('to array', function () {
    $response = OutputProgramOutput::from(outputProgramOutput());

    expect($response->toArray())
        ->toBe(outputProgramOutput());
});
