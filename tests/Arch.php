<?php

test('contracts')->expect('OpenAI\Contracts')->toOnlyUse([
    'OpenAI\ValueObjects',
    'OpenAI\Exceptions',
    'OpenAI\Resources',
]);

test('exceptions')->expect('OpenAI\Exceptions')->toOnlyUse([
    'Psr\Http\Client',
]);

test('resources')->expect('OpenAI\Resources')->toOnlyUse([
    'OpenAI\Contracts',
    'OpenAI\ValueObjects',
    'OpenAI\Exceptions',
    'OpenAI\Responses',
]);

test('responses')->expect('OpenAI\Responses')->toOnlyUse([
    'OpenAI\Enums',
    'OpenAI\Contracts',
    'OpenAI\Testing\Responses\Concerns',
]);

test('value objects')->expect('OpenAI\ValueObjects')->toOnlyUse([
    'GuzzleHttp\Psr7',
    'OpenAI\Enums',
    'OpenAI\Contracts',
]);

test('client')->expect('OpenAI\Client')->toOnlyUse([
    'OpenAI\Resources',
    'OpenAI\Contracts',
]);

test('openai')->expect('OpenAI')->toOnlyUse([
    'Psr\Http\Client',
    'GuzzleHttp\Client',
    'GuzzleHttp\Psr7',
    'OpenAI\Resources',
    'OpenAI\Contracts',
])->ignoring('OpenAI\Testing');
