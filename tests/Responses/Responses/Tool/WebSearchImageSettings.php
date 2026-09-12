<?php

use OpenAI\Responses\Responses\Tool\WebSearchImageSettings;

test('from', function () {
    $response = WebSearchImageSettings::from([
        'max_results' => 3,
        'caption' => true,
    ]);

    expect($response)
        ->toBeInstanceOf(WebSearchImageSettings::class)
        ->maxResults->toBe(3)
        ->caption->toBeTrue();
});

test('from without optional keys', function () {
    $response = WebSearchImageSettings::from([]);

    expect($response)
        ->toBeInstanceOf(WebSearchImageSettings::class)
        ->maxResults->toBeNull()
        ->caption->toBeNull()
        ->toArray()->toBe([]);
});

test('preserves a disabled caption setting', function () {
    $response = WebSearchImageSettings::from([
        'caption' => false,
    ]);

    expect($response)
        ->maxResults->toBeNull()
        ->caption->toBeFalse()
        ->toArray()->toBe([
            'caption' => false,
        ]);
});
