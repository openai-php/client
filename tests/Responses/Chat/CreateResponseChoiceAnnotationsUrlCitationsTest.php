<?php

use OpenAI\Responses\Chat\CreateResponseChoiceAnnotationsUrlCitations;

it('from', function () {

    $result = CreateResponseChoiceAnnotationsUrlCitations::from(chatCompletionWithAnnotations()['choices'][0]['message']['annotations'][0]['url_citation']);

    expect($result)
        ->endIndex->toBe(5)
        ->startIndex->toBe(0)
        ->title->toBe('Hello')
        ->url->toBe('https://example.com');
});

test('to array', function () {
    $result = CreateResponseChoiceAnnotationsUrlCitations::from(chatCompletionWithAnnotations()['choices'][0]['message']['annotations'][0]['url_citation']);

    expect($result->toArray())
        ->toBe(chatCompletionWithAnnotations()['choices'][0]['message']['annotations'][0]['url_citation']);
});
