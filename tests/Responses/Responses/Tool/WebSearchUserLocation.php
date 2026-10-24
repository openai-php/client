<?php

use OpenAI\Responses\Responses\Tool\WebSearchUserLocation;

test('from', function () {
    $response = WebSearchUserLocation::from([
        'type' => 'approximate',
        'city' => 'San Francisco',
        'country' => 'US',
        'region' => 'California',
        'timezone' => 'America/Los_Angeles',
    ]);

    expect($response)
        ->toBeInstanceOf(WebSearchUserLocation::class)
        ->type->toBe('approximate')
        ->city->toBe('San Francisco')
        ->country->toBe('US')
        ->region->toBe('California')
        ->timezone->toBe('America/Los_Angeles');
});

test('from without optional keys', function () {
    set_error_handler(static fn (int $errno, string $errstr): bool => throw new ErrorException($errstr), E_WARNING);

    try {
        $response = WebSearchUserLocation::from([
            'type' => 'approximate',
        ]);
    } finally {
        restore_error_handler();
    }

    expect($response)
        ->toBeInstanceOf(WebSearchUserLocation::class)
        ->type->toBe('approximate')
        ->country->toBeNull()
        ->city->toBeNull()
        ->region->toBeNull()
        ->timezone->toBeNull();
});

test('from null country', function () {
    $response = WebSearchUserLocation::from([
        'type' => 'approximate',
        'city' => 'London',
        'country' => null,
        'region' => null,
        'timezone' => null,
    ]);

    expect($response)
        ->toBeInstanceOf(WebSearchUserLocation::class)
        ->city->toBe('London')
        ->country->toBeNull();
});
