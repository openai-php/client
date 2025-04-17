<?php

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;

test('from', function () {
    $response = CreateStreamedResponse::from([
        '__event' => 'response.created',
        '__meta' => meta(),
        'response' => [
            'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
            'object' => 'response',
            'created_at' => 1741484430,
            'status' => 'completed',
            'output' => [
                [
                    'type' => 'message',
                    'id' => 'msg_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
                    'status' => 'completed',
                    'role' => 'assistant',
                    'content' => [
                        [
                            'type' => 'output_text',
                            'text' => 'As of today, March 9, 2025, one notable positive news story...',
                            'annotations' => [
                                [
                                    'type' => 'url_citation',
                                    'start_index' => 442,
                                    'end_index' => 557,
                                    'url' => 'https://.../?utm_source=chatgpt.com',
                                    'title' => '...',
                                ],
                                [
                                    'type' => 'url_citation',
                                    'start_index' => 962,
                                    'end_index' => 1077,
                                    'url' => 'https://.../?utm_source=chatgpt.com',
                                    'title' => '...',
                                ],
                                [
                                    'type' => 'url_citation',
                                    'start_index' => 1336,
                                    'end_index' => 1451,
                                    'url' => 'https://.../?utm_source=chatgpt.com',
                                    'title' => '...',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);

    expect($response)
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.created')
        ->response->toBeInstanceOf(CreateResponse::class)
        ->response->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('as array accessible', function () {
    $response = CreateStreamedResponse::from([
        '__event' => 'response.created',
        '__meta' => meta(),
        'response' => [
            'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        ],
    ]);

    expect($response['event'])->toBe('response.created');
});

test('to array', function () {
    $response = CreateStreamedResponse::from([
        '__event' => 'response.created',
        '__meta' => meta(),
        'response' => [
            'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        ],
    ]);

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
    $response = CreateStreamedResponse::fake([
        'event' => 'response.completed',
        'response' => ['id' => 'resp_1234'],
    ]);

    expect($response)
        ->event->toBe('response.completed')
        ->response->id->toBe('resp_1234');
});
