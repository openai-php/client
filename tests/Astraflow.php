<?php

use GuzzleHttp\Client as GuzzleClient;
use OpenAI\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

// ---------------------------------------------------------------------------
// Global endpoint
// ---------------------------------------------------------------------------

it('may create a global-endpoint client', function () {
    $client = Astraflow::client('astraflow-test-key');

    expect($client)->toBeInstanceOf(Client::class);
});

// ---------------------------------------------------------------------------
// China endpoint
// ---------------------------------------------------------------------------

it('may create a china-endpoint client', function () {
    $client = Astraflow::clientCn('astraflow-cn-test-key');

    expect($client)->toBeInstanceOf(Client::class);
});

// ---------------------------------------------------------------------------
// Factory
// ---------------------------------------------------------------------------

it('may create a client via factory', function () {
    $client = Astraflow::factory()
        ->withApiKey('astraflow-test-key')
        ->make();

    expect($client)->toBeInstanceOf(Client::class);
});

it('may create a global-endpoint client via factory', function () {
    $client = Astraflow::factory()
        ->withApiKey('astraflow-test-key')
        ->withBaseUri(Astraflow::BASE_URI)
        ->make();

    expect($client)->toBeInstanceOf(Client::class);
});

it('may create a china-endpoint client via factory', function () {
    $client = Astraflow::factory()
        ->withApiKey('astraflow-cn-test-key')
        ->withBaseUri(Astraflow::BASE_URI_CN)
        ->make();

    expect($client)->toBeInstanceOf(Client::class);
});

it('sets a custom http client via factory', function () {
    $client = Astraflow::factory()
        ->withApiKey('astraflow-test-key')
        ->withBaseUri(Astraflow::BASE_URI)
        ->withHttpClient(new GuzzleClient)
        ->make();

    expect($client)->toBeInstanceOf(Client::class);
});

it('sets a custom http header via factory', function () {
    $client = Astraflow::factory()
        ->withApiKey('astraflow-test-key')
        ->withBaseUri(Astraflow::BASE_URI)
        ->withHttpHeader('X-My-Header', 'foo')
        ->make();

    expect($client)->toBeInstanceOf(Client::class);
});

it('sets a custom query parameter via factory', function () {
    $client = Astraflow::factory()
        ->withApiKey('astraflow-test-key')
        ->withBaseUri(Astraflow::BASE_URI)
        ->withQueryParam('my-param', 'bar')
        ->make();

    expect($client)->toBeInstanceOf(Client::class);
});

it('sets a custom stream handler via factory', function () {
    $client = Astraflow::factory()
        ->withApiKey('astraflow-test-key')
        ->withBaseUri(Astraflow::BASE_URI)
        ->withHttpClient($httpClient = new GuzzleClient)
        ->withStreamHandler(fn (RequestInterface $request): ResponseInterface => $httpClient->send($request, ['stream' => true]))
        ->make();

    expect($client)->toBeInstanceOf(Client::class);
});
