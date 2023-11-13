<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Messages\ThreadMessageListResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;

test('from', function () {
    $response = ThreadMessageListResponse::from(threadMessageListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ThreadMessageListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadMessageResponse::class)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ThreadMessageListResponse::from(threadMessageListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ThreadMessageListResponse::from(threadMessageListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(threadMessageListResource());
});

test('fake', function () {
    $response = ThreadMessageListResponse::fake();

    expect($response['data'][0])
        ->id->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ');
});

test('fake with override', function () {
    $response = ThreadMessageListResponse::fake([
        'data' => [
            [
                'id' => 'run_1234',
            ],
        ],
    ]);

    expect($response['data'][0])
        ->id->toBe('run_1234');
});
