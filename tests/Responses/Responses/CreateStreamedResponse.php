<?php

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;

test('from', function () {
    $response = CreateStreamedResponse::from(createStreamedResponseResponseCreatedEvent());

    expect($response)
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.created')
        ->response->toBeInstanceOf(CreateResponse::class)
        ->response->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('as array accessible', function () {
    $response = CreateStreamedResponse::from(createStreamedResponseResponseCreatedEvent());

    expect($response['event'])->toBe('response.created');
});

test('to array', function () {
    $response = CreateStreamedResponse::from(createStreamedResponseResponseCreatedEvent());

    expect($response->toArray())
        ->toBeArray()
        ->toBe([
            'event' => 'response.created',
            'response' => [
                'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
            ],
        ]);
});

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response)
        ->event->toBe('response.created')
        ->response->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('fake with override', function () {
    $response = CreateStreamedResponse::fake(createStreamedResponseResponseCreatedEvent());

    expect($response)
        ->event->toBe('response.completed')
        ->response->id->toBe('resp_1234');
});
