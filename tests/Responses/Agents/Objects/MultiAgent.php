<?php

use OpenAI\Responses\Agents\Objects\MultiAgent;

test('from', function () {
    $result = MultiAgent::from([
        'enabled' => true,
        'max_concurrent_subagents' => 6,
    ]);

    expect($result)
        ->enabled->toBeTrue()
        ->maxConcurrentSubagents->toBe(6);
});

test('to array', function () {
    $result = MultiAgent::from([
        'enabled' => false,
        'max_concurrent_subagents' => null,
    ]);

    expect($result->toArray())
        ->toBe([
            'enabled' => false,
            'max_concurrent_subagents' => null,
        ]);
});
