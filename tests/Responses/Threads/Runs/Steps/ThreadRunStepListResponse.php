<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepListResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;

test('from', function () {
    $response = ThreadRunStepListResponse::from(threadRunStepListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ThreadRunStepListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadRunStepResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ThreadRunStepListResponse::from(threadRunStepListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ThreadRunStepListResponse::from(threadRunStepListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(threadRunStepListResource());
});

test('fake', function () {
    $response = ThreadRunStepListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('step_1spQXgbAabXFm1YXrwiGIMUz');
});

test('fake with override', function () {
    $response = ThreadRunStepListResponse::fake([
        'data' => [
            [
                'id' => 'step_1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('step_1234');
});
