<?php

test('contracts')
    ->expect('OpenAI\Contracts')
    ->toOnlyUse([
        'OpenAI\ValueObjects',
        'OpenAI\Exceptions',
        'OpenAI\Resources',
        'Psr\Http\Message\ResponseInterface',
        'OpenAI\Responses',
    ])
    ->toBeInterfaces();

test('enums')
    ->expect('OpenAI\Enums')
    ->toBeEnums();

test('exceptions')
    ->expect('OpenAI\Exceptions')
    ->toOnlyUse([
        'Psr\Http\Client',
    ])->toImplement(Throwable::class);

test('resources')->expect('OpenAI\Resources')->toOnlyUse([
    'OpenAI\Contracts',
    'OpenAI\ValueObjects',
    'OpenAI\Exceptions',
    'OpenAI\Responses',
]);

test('responses')->expect('OpenAI\Responses')->toOnlyUse([
    'Http\Discovery\Psr17Factory',
    'OpenAI\Enums',
    'OpenAI\Exceptions\ErrorException',
    'OpenAI\Contracts',
    'OpenAI\Testing\Responses\Concerns',
    'Psr\Http\Message\ResponseInterface',
    'Psr\Http\Message\StreamInterface',
]);

test('value objects')->expect('OpenAI\ValueObjects')->toOnlyUse([
    'Http\Discovery\Psr17Factory',
    'Http\Message\MultipartStream\MultipartStreamBuilder',
    'Psr\Http\Message\RequestInterface',
    'Psr\Http\Message\StreamInterface',
    'OpenAI\Enums',
    'OpenAI\Contracts',
    'OpenAI\Responses\Meta\MetaInformation',
]);

test('client')->expect('OpenAI\Client')->toOnlyUse([
    'OpenAI\Resources',
    'OpenAI\Contracts',
]);

test('openai')->expect('OpenAI')->toOnlyUse([
    'GuzzleHttp\Client',
    'GuzzleHttp\Exception\ClientException',
    'Http\Discovery\Psr17Factory',
    'Http\Discovery\Psr18ClientDiscovery',
    'Http\Message\MultipartStream\MultipartStreamBuilder',
    'OpenAI\Contracts',
    'OpenAI\Resources',
    'Psr\Http\Client',
    'Psr\Http\Message\RequestInterface',
    'Psr\Http\Message\ResponseInterface',
    'Psr\Http\Message\StreamInterface',
])->ignoring('OpenAI\Testing');
