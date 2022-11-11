<?php

use OpenAI\Requests\Completions\CreateCompletionRequest;

test('from minimal', function () {
    $request = CreateCompletionRequest::from(completionRequestMinimal());

    expect($request)
        ->toBeInstanceOf(CreateCompletionRequest::class)
        ->model->toBe('text-davinci-002')
        ->prompt->toBeNull()
        ->suffix->toBeNull()
        ->maxTokens->toBeNull()
        ->temperature->toBeNull()
        ->topP->toBeNull()
        ->n->toBeNull()
        ->stream->toBeNull()
        ->logprobs->toBeNull()
        ->echo->toBeNull()
        ->stop->toBeNull()
        ->presencePenalty->toBeNull()
        ->frequencyPenalty->toBeNull()
        ->bestOf->toBeNull()
        ->logitBias->toBeNull()
        ->user->toBeNull();
});

test('from maximal', function () {
    $request = CreateCompletionRequest::from(completionRequestMaximal());

    expect($request)
        ->toBeInstanceOf(CreateCompletionRequest::class)
        ->model->toBe('text-davinci-002')
        ->prompt->toBe('PHP is ')
        ->suffix->toBe('of all.')
        ->maxTokens->toBe(100)
        ->temperature->toBe(1.5)
        ->topP->toBe(0.5)
        ->n->toBe(3)
        ->stream->toBe(false)
        ->logprobs->toBe(5)
        ->echo->toBe(true)
        ->stop->toBe(['\n', '<|endoftext|>'])
        ->presencePenalty->toBe(-1.5)
        ->frequencyPenalty->toBe(-0.5)
        ->bestOf->toBe(10)
        ->logitBias->toBe('{"50256":-100}')
        ->user->toBe('user-1234');
});

test('via constructor', function () {
    $request = new CreateCompletionRequest(
        model: 'text-davinci-002',
        prompt: 'PHP is ',
    );

    expect($request)
        ->model->toBe('text-davinci-002')
        ->prompt->toBe('PHP is ');
});

test('via constructor only required paramenters', function () {
    $request = new CreateCompletionRequest('text-davinci-002');

    expect($request)
        ->model->toBe('text-davinci-002');
});

test('logit_bias is sent as a json string if provided as array', function () {
    $request = new CreateCompletionRequest(
        model: 'text-davinci-002',
        logitBias: ['50256' => -100],
    );

    expect($request->toArray())
        ->logit_bias->toBe('{"50256":-100}');
});

test('to array', function () {
    $request = CreateCompletionRequest::from(completionRequestMaximal());

    expect($request->toArray())
        ->toBeArray()
        ->toBe(completionRequestMaximal());
});
