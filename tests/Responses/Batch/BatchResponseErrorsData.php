<?php

use OpenAI\Responses\Batches\BatchResponseErrorsData;

test('from', function () {
    $response = BatchResponseErrorsData::from(batchResourceWithErrors()['errors']['data'][0]);

    expect($response)
        ->toBeInstanceOf(BatchResponseErrorsData::class)
        ->code->toBe('123')
        ->message->toBe('the message')
        ->param->toBe('the param')
        ->line->toBe(99);
});

test('as array accessible', function () {
    $response = BatchResponseErrorsData::from(batchResourceWithErrors()['errors']['data'][0]);

    expect($response['code'])->toBe('123');
});

test('to array', function () {
    $response = BatchResponseErrorsData::from(batchResourceWithErrors()['errors']['data'][0]);

    expect($response->toArray())
        ->toBeArray()
        ->toBe(batchResourceWithErrors()['errors']['data'][0]);
});
