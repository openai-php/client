<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Meta\MetaInformationOpenAI;
use OpenAI\Responses\Meta\MetaInformationRateLimit;

test('from response headers', function () {
    $meta = MetaInformation::from((new \GuzzleHttp\Psr7\Response(headers: metaHeaders()))->getHeaders());

    expect($meta)
        ->toBeInstanceOf(MetaInformation::class)
        ->requestId->toBe('3813fa4fa3f17bdf0d7654f0f49ebab4')
        ->openai->toBeInstanceOf(MetaInformationOpenAI::class)
        ->openai->model->toBe('text-davinci-003')
        ->openai->organization->toBe('org-1234')
        ->openai->version->toBe('2020-10-01')
        ->openai->processingMs->toBe(410)
        ->requestLimit->toBeInstanceOf(MetaInformationRateLimit::class)
        ->requestLimit->limit->toBe(3000)
        ->requestLimit->remaining->toBe(2999)
        ->requestLimit->reset->toBe('20ms')
        ->tokenLimit->toBeInstanceOf(MetaInformationRateLimit::class)
        ->tokenLimit->limit->toBe(250000)
        ->tokenLimit->remaining->toBe(249989)
        ->tokenLimit->reset->toBe('2ms');
});

test('as array accessible', function () {
    $meta = MetaInformation::from(metaHeaders());

    expect($meta['x-request-id'])->toBe('3813fa4fa3f17bdf0d7654f0f49ebab4');
});

test('to array', function () {
    $meta = MetaInformation::from(metaHeaders());

    expect($meta->toArray())
        ->toBeArray()
        ->toBe([
            'openai-model' => 'text-davinci-003',
            'openai-organization' => 'org-1234',
            'openai-processing-ms' => 410,
            'openai-version' => '2020-10-01',
            'x-ratelimit-limit-requests' => 3000,
            'x-ratelimit-limit-tokens' => 250000,
            'x-ratelimit-remaining-requests' => 2999,
            'x-ratelimit-remaining-tokens' => 249989,
            'x-ratelimit-reset-requests' => '20ms',
            'x-ratelimit-reset-tokens' => '2ms',
            'x-request-id' => '3813fa4fa3f17bdf0d7654f0f49ebab4',
        ]);
});
