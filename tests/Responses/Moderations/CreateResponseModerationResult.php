<?php

use OpenAI\Factories\Responses\Moderations\CreateResponseModerationResultFactory;
use OpenAI\Responses\Moderations\CreateResponseModerationCategory;

test('build new create response moderation result', function () {
    $result = CreateResponseModerationResultFactory::new(moderationResource()['results'][0]);

    expect($result)
        ->flagged->toBeTrue()
        ->categories->toHaveCount(7)
        ->each->toBeInstanceOf(CreateResponseModerationCategory::class);
});

test('create array from create response moderation result', function () {
    $result = CreateResponseModerationResultFactory::new(moderationResource()['results'][0]);

    expect($result->toArray())
        ->toBe(moderationResource()['results'][0]);
});
