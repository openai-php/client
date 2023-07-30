<?php

use OpenAI\Responses\FineTunes\ListEventsResponse;
use OpenAI\Responses\FineTunes\RetrieveResponseEvent;

test('from', function () {
    $response = ListEventsResponse::from(fineTuneListEventsResource(), meta());

    expect($response)
        ->toBeInstanceOf(ListEventsResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponseEvent::class);
});

test('as array accessible', function () {
    $response = ListEventsResponse::from(fineTuneListEventsResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListEventsResponse::from(fineTuneListEventsResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fineTuneListEventsResource());
});

test('fake', function () {
    $response = ListEventsResponse::fake();

    expect($response)
        ->object->toBe('list')
        ->and($response['data'][0])
        ->level->toBe('info');
});

test('fake with override', function () {
    $response = ListEventsResponse::fake([
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
