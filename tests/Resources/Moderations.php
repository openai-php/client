<?php

use OpenAI\DataObjects\Moderation\ModerationCategory;
use OpenAI\DataObjects\Moderation\ModerationResponse;
use OpenAI\DataObjects\Moderation\ModerationResult;
use OpenAI\Enums\Moderation\Category;
use OpenAI\Enums\Moderation\ModerationModel;
use OpenAI\RequestFactories\Moderation\ModerationCreateRequestFactory;
use OpenAI\Requests\Moderation\ModerationCreateRequest;

test('create', function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], moderationResource());

    $request = new ModerationCreateRequest(
        input: 'I want to kill them.',
        model: ModerationModel::TextModerationLatest,
    );

    $result = $client->moderations()->create($request);

    // Todo: These expectations are to complicated and should be moved to separate tests
    expect($result)
        ->toBeInstanceOf(ModerationResponse::class)
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

// Temporary test to demonstrate the different ways to build the request
test('create from request', function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], moderationResource());

    $request = (new ModerationCreateRequestFactory)->make([
        'input' => 'I want to kill them.',
        'model' => ModerationModel::TextModerationLatest,
    ]);

    $result = $client->moderations()->create($request);

    expect($result)->toBeInstanceOf(ModerationResponse::class);
});

// Temporary test to demonstrate the different ways to build the request
test('create from request static', function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], moderationResource());

    $request = ModerationCreateRequestFactory::new([
        'input' => 'I want to kill them.',
        'model' => ModerationModel::TextModerationLatest,
    ]);

    $result = $client->moderations()->create($request);

    expect($result)->toBeInstanceOf(ModerationResponse::class);
});

// Temporary test to demonstrate the different ways to build the request
test('create from request with model passed as string', function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], moderationResource());

    $request = ModerationCreateRequestFactory::new([
        'input' => 'I want to kill them.',
        'model' => 'text-moderation-latest',
    ]);

    $result = $client->moderations()->create($request);

    expect($result)->toBeInstanceOf(ModerationResponse::class);
});
