<?php

test('contracts')->expect('OpenAI\Contracts')->toOnlyDependOn([
    'OpenAI\ValueObjects',
    'OpenAI\Exceptions',
]);

test('exceptions')->expect('OpenAI\Exceptions')->toOnlyDependOn([
    'Psr\Http\Client',
]);

test('resources')->expect('OpenAI\Resources')->toOnlyDependOn([
    'OpenAI\Contracts',
    'OpenAI\ValueObjects',
    'OpenAI\Exceptions',
    'OpenAI\Responses',
]);

test('responses')->expect('OpenAI\Responses')->toOnlyDependOn([
    'OpenAI\Enums',
    'OpenAI\Contracts',
]);

test('value objects')->expect('OpenAI\ValueObjects')->toOnlyDependOn([
    'GuzzleHttp\Psr7',
    'OpenAI\Enums',
    'OpenAI\Contracts',
]);

test('client')->expect('OpenAI\Client')->toOnlyDependOn([
    'OpenAI\Resources',
    'OpenAI\Contracts',
]);

test('openai')->expect('OpenAI')->toOnlyDependOn([
    'Psr\Http\Client',
    'GuzzleHttp\Client',
    'GuzzleHttp\Psr7',
    'OpenAI\Resources',
    'OpenAI\Contracts',
]);
