<?php

use OpenAI\Responses\Chat\CreateResponseChoiceLogprobs;
use OpenAI\Responses\Chat\CreateStreamedResponseChoice;
use OpenAI\Responses\Chat\CreateStreamedResponseDelta;

test('from', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamFirstChunk()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->delta->toBeInstanceOf(CreateStreamedResponseDelta::class)
        ->finishReason->toBeIn(['stop', null]);
});

test('from vision chunk', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamVisionContentChunk()['choices'][0]);

    expect($result)
        ->index->toBe(0)
        ->delta->toBeInstanceOf(CreateStreamedResponseDelta::class)
        ->finishReason->toBeNull();
});

test('from with finish reason', function () {
    $data = chatCompletionStreamFirstChunk()['choices'][0];
    $data['finish_reason'] = 'stop';

    $result = CreateStreamedResponseChoice::from($data);

    expect($result)
        ->index->toBe(0)
        ->delta->toBeInstanceOf(CreateStreamedResponseDelta::class)
        ->finishReason->toBe('stop');
});

test('to array', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamFirstChunk()['choices'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionStreamFirstChunk()['choices'][0]);
});

test('from with logprobs', function () {
    $data = chatCompletionStreamContentChunk()['choices'][0];
    $data['logprobs'] = [
        'content' => [
            ['token' => 'Hello', 'logprob' => -0.31, 'bytes' => [72, 101, 108, 108, 111], 'top_logprobs' => []],
        ],
        'refusal' => null,
    ];

    $result = CreateStreamedResponseChoice::from($data);

    expect($result->logprobs)
        ->toBeInstanceOf(CreateResponseChoiceLogprobs::class)
        ->content->toHaveCount(1)
        ->content->{0}->token->toBe('Hello')
        ->content->{0}->logprob->toBe(-0.31);
});

test('from without logprobs', function () {
    $result = CreateStreamedResponseChoice::from(chatCompletionStreamContentChunk()['choices'][0]);

    expect($result->logprobs)->toBeNull();
});

test('to array with logprobs', function () {
    $data = chatCompletionStreamContentChunk()['choices'][0];
    $data['logprobs'] = [
        'content' => [
            ['token' => 'Hello', 'logprob' => -0.31, 'bytes' => [72, 101, 108, 108, 111], 'top_logprobs' => []],
        ],
    ];

    $array = CreateStreamedResponseChoice::from($data)->toArray();

    expect($array['logprobs']['content'][0])
        ->toMatchArray(['token' => 'Hello', 'logprob' => -0.31]);
});
