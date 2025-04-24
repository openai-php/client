<?php

use OpenAI\Responses\Chat\CreateResponseChoiceAnnotations;
use OpenAI\Responses\Chat\CreateResponseChoiceAnnotationsUrlCitations;

it('from ', function () {
    $result = CreateResponseChoiceAnnotations::from(chatCompletionWithAnnotations()['choices'][0]['annotations']);

    expect($result)
        ->toBeInstanceOf(CreateResponseChoiceAnnotations::class)
        ->urlCitations->toBeArray()
        ->urlCitations->toHaveLength(1)
        ->urlCitations->each->toBeInstanceOf(CreateResponseChoiceAnnotationsUrlCitations::class);

});

test('to array', function () {
    $result = CreateResponseChoiceAnnotations::from(chatCompletionWithAnnotations()['choices'][0]['annotations']);

    expect($result->toArray())
        ->toBe(chatCompletionWithAnnotations()['choices'][0]['annotations']);
});
