<?php

use OpenAI\Responses\Responses\Output\OutputMessage;

test('from', function () {
    $response = OutputMessage::from(outputBasicMessage());

    expect($response)
        ->toBeInstanceOf(OutputMessage::class)
        ->id->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->role->toBe('assistant')
        ->status->toBe('completed')
        ->type->toBe('message')
        ->phase->toBeNull()
        ->content->toBeArray();
});

test('from with phase', function () {
    $response = OutputMessage::from(outputBasicMessageWithPhase());

    expect($response)
        ->toBeInstanceOf(OutputMessage::class)
        ->phase->toBe('final_answer');
});

test('from without phase key', function () {
    $data = outputBasicMessage();
    unset($data['phase']);

    $response = OutputMessage::from($data);

    expect($response)
        ->toBeInstanceOf(OutputMessage::class)
        ->phase->toBeNull();
});

test('as array accessible', function () {
    $response = OutputMessage::from(outputBasicMessage());

    expect($response['id'])->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputMessage::from(outputBasicMessage());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputBasicMessage());
});

test('to array with phase', function () {
    $response = OutputMessage::from(outputBasicMessageWithPhase());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputBasicMessageWithPhase());
});
