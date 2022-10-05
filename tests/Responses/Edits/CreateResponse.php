<?php

use OpenAI\Responses\Edits\CreateResponse;
use OpenAI\Responses\Edits\CreateResponseChoice;
use OpenAI\Responses\Edits\CreateResponseUsage;

test('from', function () {
    $response = CreateResponse::from(edit());

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('edit')
        ->created->toBe(1664135921)
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);
});

test('as array accessible', function () {
    $response = CreateResponse::from(edit());

    expect($response['created'])->toBe(1664135921);
});

test('to array', function () {
    $response = CreateResponse::from(edit());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(edit());
});
