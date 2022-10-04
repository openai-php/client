<?php

use OpenAI\Responses\Completions\CreateResponseChoice;

test('from', function () {
    $result = CreateResponseChoice::from(completion()['choices'][0]);

    expect($result)
        ->text->toBe("el, she elaborates more on the Corruptor's role, suggesting K")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBe('length');
});

test('to array', function () {
    $result = CreateResponseChoice::from(completion()['choices'][0]);

    expect($result->toArray())
        ->toBe(completion()['choices'][0]);
});
