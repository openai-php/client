<?php

use OpenAI\Responses\Responses\Tool\CustomTool;

test('from', function () {
    $attributes = toolCustom();
    $attributes['allowed_callers'] = ['programmatic'];
    $response = CustomTool::from($attributes);

    expect($response)
        ->toBeInstanceOf(CustomTool::class)
        ->allowedCallers->toBe(['programmatic']);
});

it('to array', function () {
    $attributes = toolCustom();
    $attributes['allowed_callers'] = ['programmatic'];
    $response = CustomTool::from($attributes);

    expect($response->toArray())->toBe($attributes);
});
