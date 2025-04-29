<?php

use OpenAI\Responses\Chat\CreateResponseChoiceAnnotations;
use OpenAI\Responses\Chat\CreateResponseChoiceAnnotationsUrlCitations;

it('from url_citation annotation', function () {
    $result = CreateResponseChoiceAnnotations::from(chatCompletionWithAnnotations()['choices'][0]['message']['annotations']);

    expect($result)
        ->toBeInstanceOf(CreateResponseChoiceAnnotations::class)
        ->urlCitations->toBeArray()
        ->urlCitations->toHaveLength(1)
        ->urlCitations->each->toBeInstanceOf(CreateResponseChoiceAnnotationsUrlCitations::class);
});

test('to array', function () {
    $result = CreateResponseChoiceAnnotations::from(chatCompletionWithAnnotations()['choices'][0]['message']['annotations']);

    expect($result->toArray())
        ->toBe([
            [
                'type' => 'url_citation',
                'url_citation' => [
                    'end_index' => 5,
                    'start_index' => 0,
                    'title' => 'Hello',
                    'url' => 'https://example.com',
                ],
            ],

        ]);
});
