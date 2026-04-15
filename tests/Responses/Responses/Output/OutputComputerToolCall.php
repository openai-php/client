<?php

use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionClick;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionScreenshot;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;

test('from', function () {
    $response = OutputComputerToolCall::from(outputComputerToolCall());

    expect($response)
        ->toBeInstanceOf(OutputComputerToolCall::class)
        ->action->toBeInstanceOf(OutputComputerActionClick::class)
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->id->toBe('cu_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->status->toBe('completed')
        ->pendingSafetyChecks->toBeArray();
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

test('from with actions and without pending safety checks', function () {
    $payload = outputComputerToolCall();
    unset($payload['action'], $payload['pending_safety_checks']);
    $payload['actions'] = [
        ['type' => 'screenshot'],
    ];

    $response = OutputComputerToolCall::from($payload);

    expect($response)
        ->toBeInstanceOf(OutputComputerToolCall::class)
        ->action->toBeInstanceOf(OutputComputerActionScreenshot::class)
        ->pendingSafetyChecks->toBeArray()->toHaveCount(0)
        ->status->toBe('completed')
        ->type->toBe('computer_call');

    expect($response->toArray())
        ->toBeArray()
        ->toMatchArray([
            'action' => ['type' => 'screenshot'],
            'pending_safety_checks' => [],
        ])
        ->not->toHaveKey('actions');
});

test('from with multiple actions uses the first action', function () {
    $payload = outputComputerToolCall();
    unset($payload['action']);
    $payload['actions'] = [
        ['type' => 'screenshot'],
        ['type' => 'wait'],
    ];

    $response = OutputComputerToolCall::from($payload);

    expect($response->action)
        ->toBeInstanceOf(OutputComputerActionScreenshot::class);
});

test('from without action payload throws exception', function () {
    $payload = outputComputerToolCall();
    unset($payload['action']);
    $payload['actions'] = [];

    expect(fn (): OutputComputerToolCall => OutputComputerToolCall::from($payload))
        ->toThrow(InvalidArgumentException::class, 'Missing required computer action payload.');
});

test('from without action and actions keys throws exception', function () {
    $payload = outputComputerToolCall();
    unset($payload['action'], $payload['actions']);

    expect(fn (): OutputComputerToolCall => OutputComputerToolCall::from($payload))
        ->toThrow(InvalidArgumentException::class, 'Missing required computer action payload.');
});

test('from with malformed actions payload throws exception', function () {
    $payload = outputComputerToolCall();
    unset($payload['action']);
    $payload['actions'] = [
        ['x' => 1],
    ];

    expect(fn (): OutputComputerToolCall => OutputComputerToolCall::from($payload))
        ->toThrow(InvalidArgumentException::class, 'Missing required computer action payload.');
});
