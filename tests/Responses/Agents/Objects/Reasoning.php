<?php

use OpenAI\Responses\Agents\Objects\Reasoning;

test('from', function () {
    $result = Reasoning::from([
        'effort' => 'medium',
        'summary' => 'auto',
    ]);

    expect($result)
        ->effort->toBe('medium')
        ->summary->toBe('auto');
});

test('to array', function () {
    $result = Reasoning::from([
        'effort' => null,
        'summary' => null,
    ]);

    expect($result->toArray())
        ->toBe([
            'effort' => null,
            'summary' => null,
        ]);
});
