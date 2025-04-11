<?php
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = CreateStreamedResponse::from([
        '__event' => 'response.created',
        '__meta' => meta(),
        'response' => [
            'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
            'object' => 'response',
            'created_at' => 1699619403,
            'status' => 'completed',
            'output' => [
                [
                    'type' => 'message',
                    'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
                    'status' => 'completed',
                    'role' => 'assistant',
                    'content' => [
                        [
                            'type' => 'output_text',
                            'text' => 'The image depicts a scenic landscape',
                            'annotations' => []
                        ]
                    ]
                ]
            ]
        ]
    ]);

    expect($response)
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.created')
        ->response->toBeInstanceOf(CreateResponse::class)
        ->response->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('as array accessible', function () {
    $response = CreateStreamedResponse::from([
        '__event' => 'response.created',
        '__meta' => meta(),
        'response' => [
            'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc'
        ]
    ]);

    expect($response['event'])->toBe('response.created');
});

test('to array', function () {
    $response = CreateStreamedResponse::from([
        '__event' => 'response.created',
        '__meta' => meta(),
        'response' => [
            'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc'
        ]
    ]);

    expect($response->toArray())
        ->toBeArray()
        ->toBe([
            'event' => 'response.created',
            'response' => [
                'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc'
            ]
        ]);
});

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response)
        ->event->toBe('response.created')
        ->response->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('fake with override', function () {
    $response = CreateStreamedResponse::fake([
        'event' => 'response.completed',
        'response' => ['id' => 'asst_1234']
    ]);

    expect($response)
        ->event->toBe('response.completed')
        ->response->id->toBe('asst_1234');
});

