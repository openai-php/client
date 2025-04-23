<?php

use OpenAI\Responses\Chat\CreateResponseChoiceWebSearchOptions;
use OpenAI\Responses\Chat\CreateResponseChoiceWebSearchOptionsUserLocation;

test('from creates an instance correctly', function () {
    $attributes = [
        'search_context_size' => 'large',
        'user_location' => [
            'approximate' => [
                'country' => 'US',
                'region' => 'CA',
                'city' => 'San Francisco',
            ]
        ]
    ];

    $result = CreateResponseChoiceWebSearchOptions::from($attributes);

    expect($result)->toBeInstanceOf(CreateResponseChoiceWebSearchOptions::class)
        ->and($result->searchContextSize)->toBe('large')
        ->and($result->userLocation)->toBeInstanceOf(CreateResponseChoiceWebSearchOptionsUserLocation::class)
        ->and($result->userLocation->approximate)->toBe([
            'country' => 'US',
            'region' => 'CA',
            'city' => 'San Francisco',
        ]);
});

test('toArray returns the correct array structure', function () {
    $attributes = [
        'search_context_size' => 'medium',
        'user_location' => [
            'approximate' => [
                'country' => 'US',
                'region' => 'CA',
                'city' => 'San Francisco',
            ]
        ]
    ];

    $result = CreateResponseChoiceWebSearchOptions::from($attributes);

    expect($result->toArray())->toBe([
        'search_context_size' => 'medium',
        'user_location' => [
            'type' => 'approximate',
            'approximate' => [
                'country' => 'US',
                'region' => 'CA',
                'city' => 'San Francisco',
            ]
        ]
    ]);
});
