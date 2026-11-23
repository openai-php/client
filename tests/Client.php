<?php

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use OpenAI\Resources\Batches;
use OpenAI\Resources\Completions;
use OpenAI\Resources\Models;
use Psr\Http\Message\RequestInterface;

it('has models', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI->models())->toBeInstanceOf(Models::class);
});

it('has completions', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI->completions())->toBeInstanceOf(Completions::class);
});

it('has batches', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI->batches())->toBeInstanceOf(Batches::class);
});

it('keeps http headers scoped to the configured client', function () {
    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode(modelList(), JSON_THROW_ON_ERROR));
    $history = [];
    $handler = HandlerStack::create(new MockHandler([$response, $response, $response, $response]));
    $handler->push(Middleware::history($history));

    $client = OpenAI::factory()
        ->withApiKey('test-key')
        ->withHttpClient(new GuzzleClient(['handler' => $handler]))
        ->withHttpHeader('x-request-id', 'default')
        ->make();
    $scoped = $client->withHttpHeaders(['X-Request-Id' => 'first', 'X-Trace-Id' => 'trace-1']);

    $scoped->models()->list();
    $scoped->withHttpHeaders(['x-request-id' => 'second'])->models()->list();
    $client->models()->list();
    $scoped->models()->list();

    $requests = array_column($history, 'request');
    expect(array_map(fn (RequestInterface $request): string => $request->getHeaderLine('X-Request-Id'), $requests))
        ->toBe(['first', 'second', 'default', 'first'])
        ->and(array_map(fn (RequestInterface $request): string => $request->getHeaderLine('X-Trace-Id'), $requests))
        ->toBe(['trace-1', 'trace-1', '', 'trace-1'])
        ->and($requests[0]->getHeaderLine('Authorization'))->toBe('Bearer test-key');
});

it('passes scoped http headers to the existing stream handler', function () {
    $requests = [];
    $client = OpenAI::factory()
        ->withHttpClient(new GuzzleClient)
        ->withStreamHandler(function (RequestInterface $request) use (&$requests): Response {
            $requests[] = $request;

            return new Response(200, ['Content-Type' => 'text/event-stream'], chatCompletionStream());
        })
        ->make();

    $stream = $client->withHttpHeaders(['X-Request-Id' => 'stream-1'])->chat()->createStreamed([
        'model' => 'gpt-4o',
        'messages' => [['role' => 'user', 'content' => 'Hello']],
    ]);

    expect(iterator_to_array($stream))->not->toBeEmpty()
        ->and($requests[0]->getHeaderLine('X-Request-Id'))->toBe('stream-1');
});
