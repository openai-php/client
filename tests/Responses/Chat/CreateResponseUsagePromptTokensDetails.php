<?php

use OpenAI\Responses\Chat\CreateResponseUsagePromptTokensDetails;

test('from', function () {
    $result = CreateResponseUsagePromptTokensDetails::from(chatCompletion()['usage']['prompt_tokens_details']);

    expect($result)
        ->cachedTokens->toBe(5);
});

test('to array', function () {
    $result = CreateResponseUsagePromptTokensDetails::from(chatCompletion()['usage']['prompt_tokens_details']);

    expect($result->toArray())
        ->toBe(chatCompletion()['usage']['prompt_tokens_details']);
});
