<?php

use OpenAI\Responses\Responses\Input\AcknowledgedSafetyCheck;
use OpenAI\Responses\Responses\Input\ComputerToolCallOutput;
use OpenAI\Responses\Responses\Input\ComputerToolCallOutputScreenshot;

test('from', function () {
    $response = ComputerToolCallOutput::from(computerToolCallOutputItem());

    expect($response)
        ->toBeInstanceOf(ComputerToolCallOutput::class)
        ->type->toBe('computer_call_output')
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->currentUrl->toBe('https://example.com')
        ->output->toBeInstanceOf(ComputerToolCallOutputScreenshot::class)
        ->output->detail->toBe('auto')
        ->acknowledgedSafetyChecks->{0}->toBeInstanceOf(AcknowledgedSafetyCheck::class);
});

test('from a stored item without safety checks or a screenshot url', function () {
    $response = ComputerToolCallOutput::from([
        'id' => 'cuo_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'type' => 'computer_call_output',
        'status' => 'completed',
        'call_id' => 'call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'current_url' => null,
        'output' => [
            'type' => 'computer_screenshot',
            'detail' => 'auto',
            'file_id' => null,
            'image_url' => null,
        ],
    ]);

    expect($response)
        ->acknowledgedSafetyChecks->toBe([])
        ->currentUrl->toBeNull()
        ->output->fileId->toBeNull()
        ->output->imageUrl->toBeNull();
});

it('to array', function () {
    $response = ComputerToolCallOutput::from(computerToolCallOutputItem());

    expect($response->toArray())->toBe(computerToolCallOutputItem());
});
