<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;

test('from', function () {
    $response = ThreadRunListResponse::from(threadRunListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ThreadRunListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadRunResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ThreadRunListResponse::from(threadRunListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ThreadRunListResponse::from(threadRunListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(threadRunListResource());
});

test('fake', function () {
    $response = ThreadRunListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8');
});

test('fake with override', function () {
    $response = ThreadRunListResponse::fake([
        'data' => [
            [
                'id' => 'run_1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('run_1234');
});
