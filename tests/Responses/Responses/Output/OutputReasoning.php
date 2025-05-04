<?php

use OpenAI\Responses\Responses\Output\OutputReasoning;

test('from', function () {
    $response = OutputReasoning::from(outputReasoning());

    expect($response)
        ->toBeInstanceOf(OutputReasoning::class)
        ->summary->toBeArray()
        ->id->toBe('rs_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->type->toBe('reasoning')
        ->status->toBe('completed');
});

test('from no status', function () {
    $payload = outputReasoning();
    unset($payload['status']);

    $response = OutputReasoning::from($payload);

    expect($response)
        ->toBeInstanceOf(OutputReasoning::class)
        ->summary->toBeArray()
        ->id->toBe('rs_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->type->toBe('reasoning')
        ->status->toBeNull();
});

test('as array accessible', function () {
    $response = OutputReasoning::from(outputReasoning());

    expect($response['id'])->toBe('rs_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputReasoning::from(outputReasoning());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputReasoning());
});
