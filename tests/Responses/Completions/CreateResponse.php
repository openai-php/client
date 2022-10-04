<?php

use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Responses\Completions\CreateResponseChoice;
use OpenAI\Responses\Completions\CreateResponseUsage;

test('from', function () {
    $completion = CreateResponse::from(completion());

    expect($completion)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('cmpl-5uS6a68SwurhqAqLBpZtibIITICna')
        ->object->toBe('text_completion')
        ->created->toBe(1664136088)
        ->model->toBe('davinci')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);
});

test('as array accessible', function () {
    $completion = CreateResponse::from(completion());

    expect($completion['id'])->toBe('cmpl-5uS6a68SwurhqAqLBpZtibIITICna');
});

test('to array', function () {
    $completion = CreateResponse::from(completion());

    expect($completion->toArray())
        ->toBeArray()
        ->toBe(completion());
});
