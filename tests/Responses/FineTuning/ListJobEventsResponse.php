<?php

use OpenAI\Responses\FineTuning\ListJobEventsResponse;
use OpenAI\Responses\FineTuning\ListJobEventsResponseEvent;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = ListJobEventsResponse::from(fineTuningJobListEventsResource(), meta());

    expect($response)
        ->toBeInstanceOf(ListJobEventsResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ListJobEventsResponseEvent::class)
        ->hasMore->toBeTrue()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ListJobEventsResponse::from(fineTuningJobListEventsResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListJobEventsResponse::from(fineTuningJobListEventsResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fineTuningJobListEventsResource());
});

test('fake', function () {
    $response = ListJobEventsResponse::fake();

    expect($response)
        ->object->toBe('list')
        ->and($response['data'][0])
        ->level->toBe('info');
});

test('fake with override', function () {
    $response = ListJobEventsResponse::fake([
        'data' => [
            [
                'level' => 'error',
            ],
        ],
    ]);

    expect($response)
        ->object->toBe('list')
        ->and($response['data'][0])
        ->level->toBe('error');
});
