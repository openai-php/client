<?php

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Resources\LiveSessions;
use OpenAI\Responses\Live\Sessions\CreateResponse;
use OpenAI\Testing\ClientFake;

test('creates a Live session', function (array $transport, array $answer) {
    $history = [];
    $payload = ['session' => ['id' => 'live_123'], 'transport' => $answer];
    $handler = HandlerStack::create(new MockHandler([
        new Response(201, ['Content-Type' => 'application/json', 'x-request-id' => 'req_live'], json_encode($payload, JSON_THROW_ON_ERROR)),
    ]));
    $handler->push(Middleware::history($history));

    $client = OpenAI::factory()->withApiKey('test-key')->withHttpClient(new HttpClient(['handler' => $handler]))->make();
    $parameters = ['session' => ['model' => 'gpt-live-1.1'], 'transport' => $transport];

    $result = $client->live()->sessions()->create($parameters);

    expect($history)->toHaveCount(1);
    $request = $history[0]['request'];
    expect($request->getMethod())->toBe('POST')
        ->and((string) $request->getUri())->toBe('https://api.openai.com/v1/live/sessions')
        ->and($request->getHeaderLine('Content-Type'))->toBe('application/json')
        ->and(json_decode((string) $request->getBody(), true, flags: JSON_THROW_ON_ERROR))->toBe($parameters);

    expect($result)->toBeInstanceOf(CreateResponse::class)
        ->and($result->session['id'])->toBe('live_123')
        ->and($result->transport)->toBe($answer)
        ->and($result->toArray())->toBe($payload)
        ->and($result->meta()->requestId)->toBe('req_live');
})->with([
    'SIP' => [
        [
            'type' => 'sip',
            'destination' => '+12025550123',
            'trunk' => [
                'caller_number' => '+12025550100',
                'provider_url' => 'sips:trunk.example.com',
                'auth' => ['type' => 'digest', 'username' => 'example-user', 'password' => 'example-password'],
            ],
        ],
        ['type' => 'sip'],
    ],
    'WebRTC' => [
        ['type' => 'webrtc', 'sdp' => "v=0\r\ns=offer\r\n"],
        ['type' => 'webrtc', 'sdp' => "v=0\r\ns=answer\r\n"],
    ],
]);

test('hangs up a Live SIP session with an empty response', function () {
    $history = [];
    $handler = HandlerStack::create(new MockHandler([new Response(204)]));
    $handler->push(Middleware::history($history));

    $client = OpenAI::factory()->withApiKey('test-key')->withHttpClient(new HttpClient(['handler' => $handler]))->make();

    $result = $client->live()->sessions()->hangup('live_123');

    expect($result)->toBeNull()
        ->and($history)->toHaveCount(1);
    $request = $history[0]['request'];
    expect($request->getMethod())->toBe('POST')
        ->and((string) $request->getUri())->toBe('https://api.openai.com/v1/live/sessions/live_123/hangup')
        ->and((string) $request->getBody())->toBe('');
});

test('rejects unsuccessful Live hangup responses', function (Response $response, string $message) {
    $handler = HandlerStack::create(new MockHandler([$response]));
    $client = OpenAI::factory()->withApiKey('test-key')->withHttpClient(new HttpClient(['handler' => $handler]))->make();

    expect(fn () => $client->live()->sessions()->hangup('live_123'))->toThrow(function (ErrorException $exception) use ($response, $message) {
        expect($exception->getStatusCode())->toBe($response->getStatusCode())
            ->and($exception->getMessage())->toBe($message);
    });
})->with([
    'plain text' => [new Response(404, ['Content-Type' => 'text/plain'], 'Not found'), 'Unexpected HTTP status 404.'],
    'empty body' => [new Response(403), 'Unexpected HTTP status 403.'],
    'structured error' => [new Response(404, ['Content-Type' => 'application/json'], '{"error":{"message":"Session not found"}}'), 'Session not found'],
]);

test('fakes and records Live session requests', function () {
    $response = CreateResponse::fake();
    $client = new ClientFake([$response, '']);
    $parameters = ['session' => ['model' => 'gpt-live-1.1'], 'transport' => ['type' => 'sip']];

    $result = $client->live()->sessions()->create($parameters);
    $client->live()->sessions()->hangup($result['session']['id']);

    expect($result)->toBe($response)
        ->and($result['transport'])->toBe(['type' => 'sip']);

    $client->assertSent(LiveSessions::class, fn ($method, $arguments) => $method === 'create' && $arguments === $parameters);
    $client->assertSent(LiveSessions::class, fn ($method, $id) => $method === 'hangup' && $id === 'live_123');
});
