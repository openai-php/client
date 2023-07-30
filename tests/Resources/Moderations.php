<?php

use OpenAI\Enums\Moderations\Category;
use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Responses\Moderations\CreateResponseCategory;
use OpenAI\Responses\Moderations\CreateResponseResult;
use OpenAI\ValueObjects\Transporter\Response;

test('create', closure: function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], Response::from(moderationResource(), metaHeaders()));

    $result = $client->moderations()->create([
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseResult::class);

    expect($result->results[0])
        ->flagged->toBeTrue()
        ->categories->toHaveCount(7)
        ->each->toBeInstanceOf(CreateResponseCategory::class);

    expect($result->results[0]->categories[Category::Hate->value])
        ->category->toBe(Category::Hate)
        ->violated->toBe(false)
        ->score->toBe(0.22714105248451233);
});
