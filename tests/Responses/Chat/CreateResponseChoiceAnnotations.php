<?php

use OpenAI\Responses\Chat\CreateResponseChoiceAnnotations;
use OpenAI\Responses\Chat\CreateResponseChoiceAnnotationsUrlCitations;

it('from ', function () {
    $annotation = chatCompletionWithAnnotations()['choices'][0]['message']['annotations'];

    $attributes = [
        'url_citation' => array_filter($annotation, fn ($item) => $item['type'] === 'url_citation'),
    ];

    $result = CreateResponseChoiceAnnotations::from($attributes);

    expect($result)
        ->toBeInstanceOf(CreateResponseChoiceAnnotations::class)
        ->urlCitations->toBeArray()
        ->urlCitations->toHaveLength(1)
        ->urlCitations->each->toBeInstanceOf(CreateResponseChoiceAnnotationsUrlCitations::class);
});


test('to array', function () {
    $annotation = chatCompletionWithAnnotations()['choices'][0]['message']['annotations'][0];

    $citation = ['url_citation' => [$annotation]];
    $result = CreateResponseChoiceAnnotations::from($citation);

    expect($result->toArray())
        ->toBe([
            'type' => 'url_citation',
            'url_citation' => [
                'end_index' => 5,
                'start_index' => 0,
                'title' => 'Hello',
                'url' => 'https://example.com',
            ],
        ]);
});

