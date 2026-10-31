<?php

use OpenAI\Actions\Responses\ToolObjects;
use OpenAI\Responses\Responses\Tool\ComputerTool;

test('parses the computer tool', function () {
    $response = ToolObjects::parse([['type' => 'computer']])[0];

    expect($response)->toBeInstanceOf(ComputerTool::class)
        ->toArray()->toBe(['type' => 'computer']);
    expect($response['type'])->toBe('computer');
});
