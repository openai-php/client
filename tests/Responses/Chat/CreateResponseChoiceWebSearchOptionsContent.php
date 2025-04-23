<?php

use OpenAI\Responses\Chat\CreateResponseChoiceWebSearchOptionsContent;
use OpenAI\Responses\Chat\CreateResponseChoiceWebSearchOptionsUserLocation;

test('from', function () {
    $input = [
        'search_context_size' => 'medium',
        'user_location' => [
            'type' => 'approximate',
            'approximate' => [
                'country' => 'US',
                'region' => 'CA',
                'city' => 'San Francisco',
            ],
        ],
    ];

    $result = CreateResponseChoiceWebSearchOptionsContent::from($input);

    expect($result)
        ->searchContextSize->toBe('medium')
        ->userLocation->toBeInstanceOf(CreateResponseChoiceWebSearchOptionsUserLocation::class)
        ->userLocation->approximate->country->toBe('US')
        ->userLocation->approximate->region->toBe('CA')
        ->userLocation->approximate->city->toBe('San Francisco');

});

test('to array', function () {
    $input = [
        'search_context_size' => 'medium',
        'user_location' => [
            'type' => 'approximate',
            'approximate' => [
                'country' => 'US',
                'region' => 'CA',
                'city' => 'San Francisco',
            ],
        ],
    ];

    $result = CreateResponseChoiceWebSearchOptionsContent::from($input);

    expect($result->toArray())->toBe($input);
});
