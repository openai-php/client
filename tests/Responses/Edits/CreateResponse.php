<?php

use OpenAI\Responses\Edits\CreateResponse;
use OpenAI\Responses\Edits\CreateResponseChoice;
use OpenAI\Responses\Edits\CreateResponseUsage;

test('from', function () {
    $completion = CreateResponse::from(edit());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('edit')
        ->created->toBe(1664135921)
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);
});

test('to array', function () {
    $completion = CreateResponse::from(edit());

    expect($completion->toArray())
        ->toBeArray()
        ->toBe(edit());
});
