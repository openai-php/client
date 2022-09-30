<?php

use OpenAI\DataObjects\Moderation\Moderation;
use OpenAI\DataObjects\Moderation\ModerationCategory;
use OpenAI\DataObjects\Moderation\ModerationResult;
use OpenAI\Enums\Moderation\Category;

test('create', function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], moderationResource());

    $result = $client->moderations()->create([
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ]);

    expect($result)
        ->toBeInstanceOf(Moderation::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(ModerationResult::class);

    expect($result->results[0])
        ->flagged->toBeTrue()
        ->categories->toHaveCount(7)
        ->each->toBeInstanceOf(ModerationCategory::class);

    expect($result->results[0]->categories[0])
        ->category->toBe(Category::Hate)
        ->violated->toBe(false)
        ->score->toBe(0.22714105248451233);
});
