<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Responses\Moderations\CreateResponseResult;

test('from', function () {
    $moderation = CreateResponse::from(moderationResource(), meta());

    expect($moderation)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseResult::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $moderation = CreateResponse::from(moderationResource(), meta());

    expect($moderation['id'])->toBe('modr-5MWoLO');
});

test('to array', function () {
    $moderation = CreateResponse::from(moderationResource(), meta());

    expect($moderation->toArray())
        ->toBeArray()
        ->toBe(moderationResource());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->id->toBe('modr-5MWoLO')
        ->and($response->results[0]->categories['hate'])
        ->violated->toBeFalse();
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'id' => 'modr-1234',
        'results' => [
            [
                'categories' => [
                    'hate' => true,
                ],
            ],
        ],
    ]);

    expect($response)
        ->id->toBe('modr-1234')
        ->and($response->results[0]->categories['hate'])
        ->violated->toBeTrue();
});
