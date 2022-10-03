<?php

use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Responses\Moderations\CreateResponseResult;

test('from', function () {
    $moderation = CreateResponse::from(moderationResource());

    expect($moderation)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseResult::class);
});

test('to array', function () {
    $moderation = CreateResponse::from(moderationResource());

    expect($moderation->toArray())
        ->toBeArray()
        ->toBe(moderationResource());
});
