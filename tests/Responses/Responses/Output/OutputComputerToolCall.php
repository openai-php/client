<?php

use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionClick;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionScreenshot;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionType;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;

test('from', function () {
    $response = OutputComputerToolCall::from(outputComputerToolCall());

    expect($response)
        ->toBeInstanceOf(OutputComputerToolCall::class)
        ->actions->toHaveCount(1)
        ->actions->{0}->toBeInstanceOf(OutputComputerActionClick::class)
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->id->toBe('cu_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->status->toBe('completed')
        ->pendingSafetyChecks->toBeArray();
});

test('from a batch of actions without pending safety checks', function () {
    $response = OutputComputerToolCall::from([
        'id' => 'cu_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'type' => 'computer_call',
        'status' => 'completed',
        'actions' => [
            ['type' => 'screenshot'],
            ['type' => 'type', 'text' => 'hello'],
        ],
        'call_id' => 'call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
    ]);

    expect($response)
        ->actions->toHaveCount(2)
        ->actions->{0}->toBeInstanceOf(OutputComputerActionScreenshot::class)
        ->actions->{1}->toBeInstanceOf(OutputComputerActionType::class)
        ->pendingSafetyChecks->toBe([]);
});

test('from a single action', function () {
    $attributes = outputComputerToolCall();
    $attributes['action'] = $attributes['actions'][0];
    unset($attributes['actions']);

    $response = OutputComputerToolCall::from($attributes);

    expect($response)
        ->actions->toHaveCount(1)
        ->actions->{0}->toBeInstanceOf(OutputComputerActionClick::class);
});

test('from without actions', function () {
    $attributes = outputComputerToolCall();
    unset($attributes['actions']);

    expect(OutputComputerToolCall::from($attributes))
        ->actions->toBe([]);
});

test('to array keeps every action of a batch', function () {
    $attributes = outputComputerToolCall();
    $attributes['actions'][] = ['type' => 'screenshot'];

    expect(OutputComputerToolCall::from($attributes)->toArray())
        ->toBe($attributes);
});

test('as array accessible', function () {
    $response = OutputComputerToolCall::from(outputComputerToolCall());

    expect($response['id'])->toBe('cu_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputComputerToolCall::from(outputComputerToolCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputComputerToolCall());
});
