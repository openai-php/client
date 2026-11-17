<?php

use OpenAI\Responses\Responses\Output\OutputMessageContentOutputText;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextLogprob;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextTopLogprob;

test('preserves output text logprobs', function (array $logprobs) {
    $attributes = [
        'annotations' => [],
        'text' => 'Hello',
        'type' => 'output_text',
        'logprobs' => $logprobs,
    ];

    $response = OutputMessageContentOutputText::from($attributes);

    expect($response->toArray())->toBe($attributes)
        ->and($response['logprobs'])->toBe($logprobs);

    foreach ($response->logprobs as $item) {
        expect($item)->toBeInstanceOf(OutputMessageContentOutputTextLogprob::class);
        foreach ($item->topLogprobs as $top) {
            expect($top)->toBeInstanceOf(OutputMessageContentOutputTextTopLogprob::class);
        }
    }

    if ($logprobs !== []) {
        expect($response->logprobs[0]->token)->toBe('Hello')
            ->and($response->logprobs[0]->logprob)->toBe(-0.25)
            ->and($response->logprobs[0]->bytes)->toBe([72, 101, 108, 108, 111])
            ->and($response->logprobs[0]->topLogprobs[0]->token)->toBe('Hi');
    }
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
