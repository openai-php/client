<?php

use OpenAI\Responses\Chat\CreateResponseChoiceLogprobsContent;

test('from', function () {
    $result = CreateResponseChoiceLogprobsContent::from(chatCompletionWithLogprobs()['choices'][0]['logprobs']['content'][0]);

    expect($result)
        ->token->toBe('Hello')
        ->logprob->toBe(0.0)
        ->bytes->toBe([72, 101, 108, 108, 111])
        ->topLogprobs->toBe([
            ['token' => 'Hello', 'logprob' => 0.0, 'bytes' => [72, 101, 108, 108, 111]],
            ['token' => 'Hi', 'logprob' => -3.5, 'bytes' => [72, 105]],
        ]);
});

test('to array', function () {
    $result = CreateResponseChoiceLogprobsContent::from(chatCompletionWithLogprobs()['choices'][0]['logprobs']['content'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionWithLogprobs()['choices'][0]['logprobs']['content'][0]);
});
