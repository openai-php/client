<?php

use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseUsage;
use OpenAI\Responses\Chat\CreateResponseUsageCompletionTokensDetails;
use OpenAI\Responses\Chat\CreateResponseUsagePromptTokensDetails;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $completion = CreateResponse::from(chatCompletion(), meta());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1677652288)
        ->model->toBe('gpt-3.5-turbo')
        ->systemFingerprint->toBeNull()
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from with system fingerprint', function () {
    $completion = CreateResponse::from(chatCompletionWithSystemFingerprint(), meta());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1677652288)
        ->model->toBe('gpt-3.5-turbo')
        ->systemFingerprint->toBe('fp_44709d6fcb')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);

    expect($completion->toArray())
        ->toBeArray()
        ->toBe(chatCompletionWithSystemFingerprint());
});

test('from function response', function () {
    $completion = CreateResponse::from(chatCompletionWithFunction(), meta());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1686689333)
        ->model->toBe('gpt-3.5-turbo-0613')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from tool calls response', function () {
    $completion = CreateResponse::from(chatCompletionWithToolCalls(), meta());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1699333252)
        ->model->toBe('gpt-3.5-turbo-0613')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from usage details response', function () {
    $response = CreateResponse::from(chatCompletionWithUsageDetails(), meta());

    expect($response->usage->promptTokensDetails)
        ->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->audioTokens->toBe(0)
        ->imageTokens->toBe(0)
        ->textTokens->toBe(9);

    expect($response->usage->completionTokensDetails)
        ->toBeInstanceOf(CreateResponseUsageCompletionTokensDetails::class)
        ->audioTokens->toBe(0)
        ->reasoningTokens->toBe(0)
        ->acceptedPredictionTokens->toBe(12)
        ->rejectedPredictionTokens->toBe(0);
});

test('from OpenRouter response', function () {
    $response = CreateResponse::from(chatCompletionOpenRouter(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('gen-hPV4VUD2Jc8f59N2QPpK5n4834mR')
        ->object->toBe('chat.completion')
        ->created->toBe(1708000000)
        ->model->toBe('google/gemma-7b-it:free')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->{0}->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from OpenRouter OpenAI response', function () {
    $response = CreateResponse::from(chatCompletionOpenRouterOpenAI(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('gen-hPV4VUD2Jc8f59N2QPpK5n4834mR')
        ->object->toBe('chat.completion')
        ->created->toBe(1708000000)
        ->model->toBe('openai/gpt-4-turbo-preview')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->{0}->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);

    expect($response->usage->promptTokensDetails)
        ->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->audioTokens->toBeNull()
        ->imageTokens->toBeNull()
        ->textTokens->toBe(21);

    expect($response->usage->completionTokensDetails)
        ->toBeInstanceOf(CreateResponseUsageCompletionTokensDetails::class)
        ->audioTokens->toBeNull()
        ->reasoningTokens->toBe(0)
        ->acceptedPredictionTokens->toBe(21)
        ->rejectedPredictionTokens->toBe(0);
});

test('from OpenRouter Google response', function () {
    $response = CreateResponse::from(chatCompletionOpenRouterGoogle(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('gen-hPV4VUD2Jc8f59N2QPpK5n4834mR')
        ->object->toBe('chat.completion')
        ->created->toBe(1708000000)
        ->model->toBe('google/gemini-pro')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->{0}->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from OpenRouter xAI response', function () {
    $response = CreateResponse::from(chatCompletionOpenRouterXAI(), meta());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('gen-hPV4VUD2Jc8f59N2QPpK5n4834mR')
        ->object->toBe('chat.completion')
        ->created->toBe(1708000000)
        ->model->toBe('xai/grok-1')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->{0}->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);

    expect($response->usage->promptTokensDetails)
        ->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->audioTokens->toBeNull()
        ->imageTokens->toBeNull()
        ->textTokens->toBe(21);

    expect($response->usage->completionTokensDetails)
        ->toBeInstanceOf(CreateResponseUsageCompletionTokensDetails::class)
        ->audioTokens->toBeNull()
        ->reasoningTokens->toBe(0)
        ->acceptedPredictionTokens->toBe(36)
        ->rejectedPredictionTokens->toBe(0);
});

test('as array accessible', function () {
    $completion = CreateResponse::from(chatCompletion(), meta());

    expect(isset($completion['id']))->toBeTrue();

    expect($completion['id'])->toBe('chatcmpl-123');
});

test('to array', function () {
    $completion = CreateResponse::from(chatCompletion(), meta());

    expect($completion->toArray())
        ->toBeArray()
        ->toBe(chatCompletion());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->id->toBe('chatcmpl-123');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'id' => 'chatcmpl-111',
        'choices' => [
            [
                'message' => [
                    'content' => 'Hi, there!',
                ],
            ],
        ],
        'system_fingerprint' => 'fp_44709d6fcb',
    ]);

    expect($response)
        ->id->toBe('chatcmpl-111')
        ->systemFingerprint->toBe('fp_44709d6fcb')
        ->and($response->choices[0])
        ->message->content->toBe('Hi, there!')
        ->message->role->toBe('assistant');
});

test('fake with function call', function () {
    $response = CreateResponse::fake([
        'id' => 'chatcmpl-111',
        'choices' => [
            [
                'message' => [
                    'function_call' => [
                        'name' => 'get_current_weather',
                        'arguments' => "{\n  \"location\": \"Boston, MA\"\n}",
                    ],
                ],
                'finish_reason' => 'function_call',
            ],
        ],
    ]);

    expect($response)
        ->id->toBe('chatcmpl-111')
        ->and($response->choices[0])
        ->message->functionCall->name->toBe('get_current_weather')
        ->message->functionCall->arguments->toBe("{\n  \"location\": \"Boston, MA\"\n}")
        ->finishReason->toBe('function_call');
});

test('fake with tool calls', function () {
    $response = CreateResponse::fake([
        'id' => 'chatcmpl-111',
        'choices' => [
            [
                'message' => [
                    'tool_calls' => [
                        [
                            'id' => 'call_trlgKnhMpYSC7CFXKw3CceUZ',
                            'type' => 'function',
                            'function' => [
                                'name' => 'get_current_weather',
                                'arguments' => "{\n  \"location\": \"Boston, MA\"\n}",
                            ],
                        ],
                    ],
                ],
                'finish_reason' => 'tool_calls',
            ],
        ],
    ]);

    expect($response)
        ->id->toBe('chatcmpl-111')
        ->and($response->choices[0])
        ->finishReason->toBe('tool_calls')
        ->and($response->choices[0]->message->toolCalls[0])
        ->id->toBe('call_trlgKnhMpYSC7CFXKw3CceUZ')
        ->type->toBe('function')
        ->function->name->toBe('get_current_weather')
        ->function->arguments->toBe("{\n  \"location\": \"Boston, MA\"\n}");
});
