<?php

use OpenAI\Factories\Responses\Moderations\CreateResponseFactory;
use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Responses\Moderations\CreateResponseModerationResult;

test('build new create moderation response', function () {
    $moderation = CreateResponseFactory::new(moderationResource());

    expect($moderation)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseModerationResult::class);
});

test('returns the original api response', function () {
    $moderation = CreateResponseFactory::new(moderationResource());

    expect($moderation->toArray())
        ->toBeArray()
        ->toBe(moderationResource());
});
