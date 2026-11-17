<?php

use OpenAI\Responses\Responses\Output\OutputMessageContentOutputText;

test('preserves output text logprobs', function (array $logprobs) {
    $attributes = [
        'annotations' => [],
        'text' => 'Hello',
        'type' => 'output_text',
        'logprobs' => $logprobs,
    ];

    $response = OutputMessageContentOutputText::from($attributes);

    expect($response->toArray())->toBe($attributes)
        ->and($response->logprobs)->toBe($logprobs)
        ->and($response['logprobs'])->toBe($logprobs);
})->with([
    'populated' => [[[
        'token' => 'Hello',
        'logprob' => -0.25,
        'bytes' => [72, 101, 108, 108, 111],
        'top_logprobs' => [[
            'token' => 'Hi',
            'logprob' => -1.5,
            'bytes' => [72, 105],
        ]],
    ]]],
    'empty' => [[]],
]);

test('omits logprobs when absent from output text', function () {
    $attributes = ['annotations' => [], 'text' => 'Hello', 'type' => 'output_text'];
    $response = OutputMessageContentOutputText::from($attributes);

    expect($response->toArray())->toBe($attributes)
        ->and($response->logprobs)->toBeNull();
});
