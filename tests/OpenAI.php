<?php

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OpenAI\Client;

it('may create a client', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets organization when provided', function () {
    $openAI = OpenAI::client('foo', 'nunomaduro');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('accepts a custom http client', function () {
    $mock = new MockHandler([
        new Response(200, [], '{"id":"test-id","object":"text_completion","created":1589478378,"model":"text-davinci-003","choices":[{"text":"\n\nThis is indeed a test","index":0,"logprobs":null,"finish_reason":"length"}],"usage":{"prompt_tokens":5,"completion_tokens":7,"total_tokens":12}}'),
    ]);
    $handlerStack = HandlerStack::create($mock);
    $client = new GuzzleClient(['handler' => $handlerStack]);
    $openAI = OpenAI::client('foo', client: $client);
    $response = $openAI->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => 'Say this is a test',
    ]);

    expect($response->id)->toBe('test-id');
});
