<?php

use OpenAI\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Client\ClientInterface;

it('may create a client', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets organization when provided', function () {
    $openAI = OpenAI::client('foo', 'nunomaduro');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('accepts a custom http client', function () {
    $client = new class implements ClientInterface {
        public function sendRequest(RequestInterface $request): ResponseInterface {
            throw new \LogicException('Not implemented');
        }
    };

    $openAI = OpenAI::client('foo', client: );

    expect($openAI)->toBeInstanceOf(Client::class);
});
