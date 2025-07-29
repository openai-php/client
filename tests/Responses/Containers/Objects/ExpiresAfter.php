<?php

use OpenAI\Responses\Containers\Objects\ExpiresAfter;

test('from', function () {
    $result = ExpiresAfter::from([
        'anchor' => 'last_active_at',
        'minutes' => 60,
    ]);

    expect($result)
        ->anchor->toBe('last_active_at')
        ->minutes->toBe(60);
});

test('to array', function () {
    $result = ExpiresAfter::from([
        'anchor' => 'last_active_at',
        'minutes' => 60,
    ]);

    expect($result->toArray())
        ->toBe([
            'anchor' => 'last_active_at',
            'minutes' => 60,
        ]);
});
