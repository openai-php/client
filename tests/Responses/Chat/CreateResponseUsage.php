<?php

use OpenAI\Responses\Chat\CreateResponseUsage;
use OpenAI\Responses\Chat\CreateResponseUsageCompletionTokensDetails;
use OpenAI\Responses\Chat\CreateResponseUsagePromptTokensDetails;

test('from', function () {
    $result = CreateResponseUsage::from(chatCompletion()['usage']);

    expect($result)
        ->promptTokens->toBe(9)
        ->completionTokens->toBe(12)
        ->totalTokens->toBe(21)
        ->promptTokensDetails->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->completionTokensDetails->toBeInstanceOf(CreateResponseUsageCompletionTokensDetails::class);
});

test('from (OpenRouter)', function () {
    $result = CreateResponseUsage::from(chatCompletionOpenRouter()['usage']);

    expect($result)
        ->promptTokens->toBe(13)
        ->completionTokens->toBe(20)
        ->totalTokens->toBe(33)
        ->promptTokensDetails->toBeNull()
        ->completionTokensDetails->toBeNull();
});

test('from (LiteLLM)', function () {
    $result = CreateResponseUsage::from(chatCompletionLiteLlmImage()['usage']);

    expect($result)
        ->promptTokens->toBe(21)
        ->completionTokens->toBe(36)
        ->totalTokens->toBe(57)
        ->promptTokensDetails->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->completionTokensDetails->toBeNull();
});

test('from (OpenRouter OpenAI)', function () {
    $result = CreateResponseUsage::from(chatCompletionOpenRouterOpenAI()['usage']);

    expect($result)
        ->promptTokens->toBe(21)
        ->completionTokens->toBe(21)
        ->totalTokens->toBe(42)
        ->promptTokensDetails->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->completionTokensDetails->toBeInstanceOf(CreateResponseUsageCompletionTokensDetails::class);
});

test('from (OpenRouter Google)', function () {
    $result = CreateResponseUsage::from(chatCompletionOpenRouterGoogle()['usage']);

    expect($result)
        ->promptTokens->toBe(10)
        ->completionTokens->toBe(138)
        ->totalTokens->toBe(148)
        ->promptTokensDetails->toBeNull()
        ->completionTokensDetails->toBeNull();
});

test('from (OpenRouter xAI)', function () {
    $result = CreateResponseUsage::from(chatCompletionOpenRouterXAI()['usage']);

    expect($result)
        ->promptTokens->toBe(21)
        ->completionTokens->toBe(36)
        ->totalTokens->toBe(392)
        ->promptTokensDetails->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->completionTokensDetails->toBeInstanceOf(CreateResponseUsageCompletionTokensDetails::class);
});

test('to array', function () {
    $result = CreateResponseUsage::from(chatCompletion()['usage']);

    expect($result->toArray())
        ->toBe(chatCompletion()['usage']);
});
