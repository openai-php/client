<?php

use OpenAI\Responses\Meta\MetaInformation;

function metaHeaders(): array
{
    return [
        'openai-model' => ['gpt-3.5-turbo-instruct'],
        'openai-organization' => ['org-1234'],
        'openai-processing-ms' => [410],
        'openai-version' => ['2020-10-01'],
        'x-ratelimit-limit-requests' => [3000],
        'x-ratelimit-limit-tokens' => [250000],
        'x-ratelimit-remaining-requests' => [2999],
        'x-ratelimit-remaining-tokens' => [249989],
        'x-ratelimit-reset-requests' => ['20ms'],
        'x-ratelimit-reset-tokens' => ['2ms'],
        'x-request-id' => ['3813fa4fa3f17bdf0d7654f0f49ebab4'],
    ];
}

function metaHeadersFromAzure(): array
{
    return [
        'openai-model' => ['gpt-3.5-turbo-instruct'],
        'openai-processing-ms' => [3482.8264],
        'x-request-id' => ['3813fa4fa3f17bdf0d7654f0f49ebab4'],
        'x-ratelimit-remaining-requests' => ['119'],
        'x-ratelimit-remaining-tokens' => ['119968'],
    ];
}

function metaHeadersWithDifferentCases(): array
{
    return [
        'Openai-Model' => ['gpt-3.5-turbo-instruct'],
        'OPENAI-ORGANIZATION' => ['org-1234'],
        'openai-processing-ms' => [410],
        'openai-version' => ['2020-10-01'],
        'x-request-id' => ['3813fa4fa3f17bdf0d7654f0f49ebab4'],
    ];
}

function meta(): MetaInformation
{
    return MetaInformation::from(metaHeaders());
}
