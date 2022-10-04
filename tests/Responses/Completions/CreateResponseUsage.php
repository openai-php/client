<?php

use OpenAI\Responses\Completions\CreateResponseUsage;

test('from', function () {
    $result = CreateResponseUsage::from(completion()['usage']);

    expect($result)
        ->promptTokens->toBe(1)
        ->completionTokens->toBe(16)
        ->totalTokens->toBe(17);
});

test('to array', function () {
    $result = CreateResponseUsage::from(completion()['usage']);

    expect($result->toArray())
        ->toBe(completion()['usage']);
});
