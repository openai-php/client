<?php

use OpenAI\Responses\Audio\Streaming\TranscriptTextDelta;
use OpenAI\Responses\Audio\Streaming\TranscriptTextDone;
use OpenAI\Responses\Meta\MetaInformation;

function transcriptLogprobsMeta(): MetaInformation
{
    return MetaInformation::from([]);
}

test('transcript delta keeps the logprob values returned by the api', function () {
    $response = TranscriptTextDelta::from([
        'delta' => 'Hello',
        'logprobs' => [
            ['token' => 'Hello', 'logprob' => -0.0123, 'bytes' => [72, 101, 108, 108, 111]],
        ],
    ], transcriptLogprobsMeta());

    expect($response->logprobs)->toHaveCount(1)
        ->and($response->logprobs[0]->token)->toBe('Hello')
        ->and($response->logprobs[0]->logprob)->toBe(-0.0123)
        ->and($response->logprobs[0]->bytes)->toBe([72, 101, 108, 108, 111])
        ->and($response->toArray()['logprobs'][0])->toBe([
            'bytes' => [72, 101, 108, 108, 111],
            'logprob' => -0.0123,
            'token' => 'Hello',
        ]);
});

test('transcript done keeps the logprob values returned by the api', function () {
    $response = TranscriptTextDone::from([
        'text' => 'Hello',
        'logprobs' => [
            ['token' => 'Hello', 'logprob' => -0.5, 'bytes' => [72]],
        ],
    ], transcriptLogprobsMeta());

    expect($response->logprobs[0]->logprob)->toBe(-0.5);
});
