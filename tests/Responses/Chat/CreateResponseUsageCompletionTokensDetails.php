<?php

use OpenAI\Responses\Chat\CreateResponseUsageCompletionTokensDetails;

test('from', function () {
    $result = CreateResponseUsageCompletionTokensDetails::from(chatCompletion()['usage']['completion_tokens_details']);

    expect($result)
        ->audioTokens->toBeNull()
        ->reasoningTokens->toBe(0)
        ->acceptedPredictionTokens->toBe(0)
        ->rejectedPredictionTokens->toBe(0);
});

test('to array', function () {
    $result = CreateResponseUsageCompletionTokensDetails::from(chatCompletion()['usage']['completion_tokens_details']);

    expect($result->toArray())
        ->toBe(chatCompletion()['usage']['completion_tokens_details']);
});
