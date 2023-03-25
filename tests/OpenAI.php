<?php

use GuzzleHttp\Client as GuzzleClient;
use OpenAI\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

it('may create a client', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets organization when provided', function () {
    $openAI = OpenAI::client('foo', 'nunomaduro');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('may create a client via factory', function () {
    $openAI = OpenAI::factory()
        ->withApiKey('foo')
        ->make();

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets an organization via factory', function () {
    $openAI = OpenAI::factory()
        ->withOrganization('nunomaduro')
        ->make();

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets a custom client via factory', function () {
    $openAI = OpenAI::factory()
        ->withHttpClient(new GuzzleClient())
        ->make();

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets a custom base url via factory', function () {
    $openAI = OpenAI::factory()
        ->withBaseUri('https://openai.example.com/v1')
        ->make();

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets a custom header via factory', function () {
    $openAI = OpenAI::factory()
        ->withHttpHeader('X-My-Header', 'foo')
        ->make();

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets a custom query parameter via factory', function () {
    $openAI = OpenAI::factory()
        ->withQueryParam('my-param', 'bar')
        ->make();

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets a custom stream handler via factory', function () {
    $openAI = OpenAI::factory()
        ->withHttpClient($client = new GuzzleClient())
        ->withStreamHandler(fn (RequestInterface $request): ResponseInterface => $client->send($request, ['stream' => true]))
        ->make();

    expect($openAI)->toBeInstanceOf(Client::class);
});
