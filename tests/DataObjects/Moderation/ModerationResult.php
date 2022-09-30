<?php

use OpenAI\DataObjects\Moderation\ModerationCategory;
use OpenAI\Factories\DataObjects\Moderation\ModerationResultFactory;

test('build new moderation result', function () {
    $result = ModerationResultFactory::new(moderationResource()['results'][0]);

    expect($result)
        ->flagged->toBeTrue()
        ->categories->toHaveCount(7)
        ->each->toBeInstanceOf(ModerationCategory::class);
});

test('create array from moderation result', function () {
    $result = ModerationResultFactory::new(moderationResource()['results'][0]);

    expect($result->toArray())
        ->flagged->toBeTrue()
        ->categories->toHaveCount(7)
        ->each->toBeArray();
});
