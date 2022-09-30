<?php

use OpenAI\DataObjects\Moderation\Moderation;
use OpenAI\DataObjects\Moderation\ModerationResult;
use OpenAI\Factories\DataObjects\Moderation\ModerationFactory;

test('build new moderation', function () {
    $moderation = ModerationFactory::new(moderationResource());

    expect($moderation)
        ->toBeInstanceOf(Moderation::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(ModerationResult::class);
});

test('create array from moderation', function () {
    $moderation = ModerationFactory::new(moderationResource());

    expect($moderation->toArray())
        ->toBeArray()
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeArray();
});
