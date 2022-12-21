<?php

use OpenAI\Requests\Completions\CreateCompletionRequest;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Responses\Completions\CreateResponseChoice;
use OpenAI\Responses\Completions\CreateResponseUsage;

test('create from request', function () {
    $client = mockClient('POST', 'completions', [
        'model' => 'text-davinci-002',
        'prompt' => 'hi',
    ], completion());

    $result = $client->completions()->create(new CreateCompletionRequest(
        model: 'text-davinci-002',
        prompt: 'hi',
    ));

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('cmpl-5uS6a68SwurhqAqLBpZtibIITICna')
        ->object->toBe('text_completion')
        ->created->toBe(1664136088)
        ->model->toBe('text-davinci-002')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->choices[0])
        ->text->toBe("el, she elaborates more on the Corruptor's role, suggesting K")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBe('length');

    expect($result->usage)
        ->promptTokens->toBe(1)
        ->completionTokens->toBe(16)
        ->totalTokens->toBe(17);
});

test('create from array', function () {
    $client = mockClient('POST', 'completions', [
        'model' => 'text-davinci-002',
        'prompt' => 'hi',
    ], completion());

    $result = $client->completions()->create([
        'model' => 'text-davinci-002',
        'prompt' => 'hi',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class);
});
