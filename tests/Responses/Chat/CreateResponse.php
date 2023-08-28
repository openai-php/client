<?php

use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseUsage;

test('from', function () {
    $completion = CreateResponse::from(chatCompletion());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1677652288)
        ->model->toBe('gpt-3.5-turbo')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);
});

test('from function response', function () {
    $completion = CreateResponse::from(chatCompletionWithFunction());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1686689333)
        ->model->toBe('gpt-3.5-turbo-0613')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);
});

test('as array accessible', function () {
    $completion = CreateResponse::from(chatCompletion());

    expect($completion['id'])->toBe('chatcmpl-123');
});

test('to array', function () {
    $completion = CreateResponse::from(chatCompletion());

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
    ]);

    expect($response)
        ->id->toBe('chatcmpl-111')
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
