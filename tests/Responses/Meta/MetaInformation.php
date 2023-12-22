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
        ->openai->model->toBe('gpt-3.5-turbo-instruct')
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

test('from response headers without "x-request-id"', function () {
    $headers = metaHeaders();
    unset($headers['x-request-id']);

    $meta = MetaInformation::from($headers);

    expect($meta)
        ->toBeInstanceOf(MetaInformation::class)
        ->requestId->toBeNull();
});

test('from azure response headers', function () {
    $meta = MetaInformation::from((new \GuzzleHttp\Psr7\Response(headers: metaHeadersFromAzure()))->getHeaders());

    expect($meta)
        ->toBeInstanceOf(MetaInformation::class)
        ->requestId->toBe('3813fa4fa3f17bdf0d7654f0f49ebab4')
        ->openai->toBeInstanceOf(MetaInformationOpenAI::class)
        ->openai->model->toBe('gpt-3.5-turbo-instruct')
        ->openai->organization->toBeNull()
        ->openai->version->toBeNull()
        ->openai->processingMs->toBe(3482)
        ->requestLimit->toBeInstanceOf(MetaInformationRateLimit::class)
        ->requestLimit->limit->toBeNull()
        ->requestLimit->remaining->toBe(119)
        ->requestLimit->reset->toBeNull()
        ->tokenLimit->toBeInstanceOf(MetaInformationRateLimit::class)
        ->tokenLimit->limit->toBeNull()
        ->tokenLimit->remaining->toBe(119968)
        ->tokenLimit->reset->toBeNull();
});

test('from azure response headers without rate limit headers ', function () {
    $headers = metaHeadersFromAzure();
    unset($headers['x-ratelimit-remaining-requests']);
    unset($headers['x-ratelimit-remaining-tokens']);

    $meta = MetaInformation::from((new \GuzzleHttp\Psr7\Response(headers: $headers))->getHeaders());

    expect($meta)
        ->toBeInstanceOf(MetaInformation::class)
        ->requestLimit->toBeNull()
        ->tokenLimit->toBeNull();
});

test('from azure response headers without processing time', function () {
    $headers = metaHeadersFromAzure();
    unset($headers['openai-processing-ms']);

    $meta = MetaInformation::from((new \GuzzleHttp\Psr7\Response(headers: $headers))->getHeaders());

    expect($meta)
        ->toBeInstanceOf(MetaInformation::class)
        ->openai->toBeInstanceOf(MetaInformationOpenAI::class)
        ->openai->processingMs->toBeNull();
});

test('from response headers in different cases', function () {
    $meta = MetaInformation::from((new \GuzzleHttp\Psr7\Response(headers: metaHeadersWithDifferentCases()))->getHeaders());

    expect($meta)
        ->toBeInstanceOf(MetaInformation::class)
        ->requestId->toBe('3813fa4fa3f17bdf0d7654f0f49ebab4')
        ->openai->toBeInstanceOf(MetaInformationOpenAI::class)
        ->openai->model->toBe('gpt-3.5-turbo-instruct')
        ->openai->organization->toBe('org-1234')
        ->openai->version->toBe('2020-10-01')
        ->openai->processingMs->toBe(410)
        ->requestLimit->toBeNull()
        ->tokenLimit->toBeNull();
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
            'openai-model' => 'gpt-3.5-turbo-instruct',
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

test('to array from azure', function () {
    $meta = MetaInformation::from(metaHeadersFromAzure());

    expect($meta->toArray())
        ->toBeArray()
        ->toBe([
            'openai-model' => 'gpt-3.5-turbo-instruct',
            'openai-processing-ms' => 3482,
            'x-ratelimit-remaining-requests' => 119,
            'x-ratelimit-remaining-tokens' => 119968,
            'x-request-id' => '3813fa4fa3f17bdf0d7654f0f49ebab4',
        ]);
});
