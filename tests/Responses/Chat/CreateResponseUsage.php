<?php

use OpenAI\Responses\Chat\CreateResponseUsage;

test('from', function () {
    $result = CreateResponseUsage::from(chatCompletion()['usage']);

    expect($result)
        ->promptTokens->toBe(9)
        ->completionTokens->toBe(12)
        ->totalTokens->toBe(21);
});

test('to array', function () {
    $result = CreateResponseUsage::from(chatCompletion()['usage']);

    expect($result->toArray())
        ->toBe(chatCompletion()['usage']);
});
