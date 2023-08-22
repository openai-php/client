<?php

use OpenAI\Responses\Meta\MetaInformation;

function metaHeaders(): array
{
    return [
        'openai-model' => 'text-davinci-003',
        'openai-organization' => 'org-1234',
        'openai-processing-ms' => '410',
        'openai-version' => '2020-10-01',
        'x-ratelimit-limit-requests' => '3000',
        'x-ratelimit-limit-tokens' => '250000',
        'x-ratelimit-remaining-requests' => '2999',
        'x-ratelimit-remaining-tokens' => '249989',
        'x-ratelimit-reset-requests' => '20ms',
        'x-ratelimit-reset-tokens' => '2ms',
        'x-request-id' => '3813fa4fa3f17bdf0d7654f0f49ebab4',
    ];
}

function meta(): MetaInformation
{
    return MetaInformation::from(metaHeaders());
}
