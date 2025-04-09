<?php

use OpenAI\Enums\Moderations\Category;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Responses\Moderations\CreateResponseCategory;
use OpenAI\Responses\Moderations\CreateResponseResult;
use OpenAI\ValueObjects\Transporter\Response;

test('create legacy', closure: function () {
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
        ->categories->toHaveCount(11)
        ->each->toBeInstanceOf(CreateResponseCategory::class);

    expect($result->results[0]->categories[Category::Hate->value])
        ->category->toBe(Category::Hate)
        ->violated->toBe(false)
        ->score->toBe(0.22714105248451233);

    expect($result->results[0]->categories[Category::Violence->value])
        ->category->toBe(Category::Violence)
        ->violated->toBe(true)
        ->score->toBe(0.9223177433013916);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create omni', closure: function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'omni-moderation-latest',
        'input' => 'I want to kill them.',
    ], Response::from(moderationOmniResource(), metaHeaders()));

    $result = $client->moderations()->create([
        'model' => 'omni-moderation-latest',
        'input' => 'I want to kill them.',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('omni-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseResult::class);

    expect($result->results[0])
        ->flagged->toBeTrue()
        ->categories->toHaveCount(13)
        ->each->toBeInstanceOf(CreateResponseCategory::class);

    expect($result->results[0]->categories[Category::Illicit->value])
        ->category->toBe(Category::Illicit)
        ->violated->toBe(false)
        ->score->toBe(0.1602763684674149);

    expect($result->results[0]->categories[Category::IllicitViolent->value])
        ->category->toBe(Category::IllicitViolent)
        ->violated->toBe(true)
        ->score->toBe(0.9223177433013916);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
