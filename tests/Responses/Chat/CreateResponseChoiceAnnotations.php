<?php

use OpenAI\Responses\Chat\CreateResponseChoiceAnnotations;
use OpenAI\Responses\Chat\CreateResponseChoiceAnnotationsUrlCitations;

it('from url_citation annotation', function () {
    $result = CreateResponseChoiceAnnotations::from(chatCompletionWithAnnotations()['choices'][0]['message']['annotations'][0]);

    expect($result)
        ->type->toBe('url_citation')
        ->urlCitations->toBeInstanceOf(CreateResponseChoiceAnnotationsUrlCitations::class);
});

test('to array', function () {
    $result = CreateResponseChoiceAnnotations::from(chatCompletionWithAnnotations()['choices'][0]['message']['annotations'][0]);

    expect($result->toArray())
        ->toBe(chatCompletionWithAnnotations()['choices'][0]['message']['annotations'][0]);
});
