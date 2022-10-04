<?php

use OpenAI\Responses\Edits\CreateResponseUsage;

test('from', function () {
    $result = CreateResponseUsage::from(edit()['usage']);

    expect($result)
        ->promptTokens->toBe(25)
        ->completionTokens->toBe(28)
        ->totalTokens->toBe(53);
});

test('to array', function () {
    $result = CreateResponseUsage::from(edit()['usage']);

    expect($result->toArray())
        ->toBe(edit()['usage']);
});
