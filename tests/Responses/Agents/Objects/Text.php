<?php

use OpenAI\Responses\Agents\Objects\Text;

test('from', function () {
    $result = Text::from([
        'format' => ['type' => 'text'],
        'verbosity' => 'medium',
    ]);

    expect($result)
        ->format->toBe(['type' => 'text'])
        ->verbosity->toBe('medium');
});

test('to array', function () {
    $result = Text::from([
        'format' => ['type' => 'json_schema', 'schema' => ['type' => 'object']],
        'verbosity' => 'low',
    ]);

    expect($result->toArray())
        ->toBe([
            'format' => ['type' => 'json_schema', 'schema' => ['type' => 'object']],
            'verbosity' => 'low',
        ]);
});
