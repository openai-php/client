<?php

use OpenAI\Responses\Agents\Environments\Objects\Desktop;

test('from', function () {
    $result = Desktop::from(['enabled' => true]);

    expect($result)
        ->enabled->toBeTrue();
});

test('to array', function () {
    $result = Desktop::from(['enabled' => false]);

    expect($result->toArray())
        ->toBe(['enabled' => false]);
});
