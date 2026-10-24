<?php

use OpenAI\Responses\Agents\Environments\Objects\Packages;

test('from', function () {
    $result = Packages::from(['npm' => ['typescript'], 'python' => ['requests'], 'system' => ['jq']]);

    expect($result)
        ->npm->toBe(['typescript'])
        ->python->toBe(['requests'])
        ->system->toBe(['jq']);
});

test('to array', function () {
    $result = Packages::from(['npm' => [], 'python' => [], 'system' => []]);

    expect($result->toArray())
        ->toBe(['npm' => [], 'python' => [], 'system' => []]);
});
