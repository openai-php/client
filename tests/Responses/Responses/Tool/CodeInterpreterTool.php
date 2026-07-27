<?php

use OpenAI\Responses\Responses\Tool\CodeInterpreterTool;

test('from', function () {
    $attributes = [
        'container' => 'cntr_123',
        'type' => 'code_interpreter',
        'allowed_callers' => ['programmatic'],
    ];

    $response = CodeInterpreterTool::from($attributes);

    expect($response)
        ->toBeInstanceOf(CodeInterpreterTool::class)
        ->allowedCallers->toBe(['programmatic'])
        ->toArray()->toBe($attributes);
});
