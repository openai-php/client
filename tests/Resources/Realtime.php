<?php

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response as HttpResponse;
use OpenAI\Responses\Realtime\ClientSecretResponse;
use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;
use OpenAI\Testing\Responses\Fixtures\Realtime\ClientSecretResponseFixture;
use OpenAI\ValueObjects\Transporter\Response;

test('creates a GA realtime client secret', function (array $parameters, array $session) {
    $history = [];
    $answer = ['value' => 'ek_temporary', 'expires_at' => 1756310470, 'session' => $session];
    $handler = HandlerStack::create(new MockHandler([
        new HttpResponse(200, [
            'Content-Type' => 'application/json',
            'x-request-id' => 'req_realtime',
        ], json_encode($answer, JSON_THROW_ON_ERROR)),
    ]));
    $handler->push(Middleware::history($history));

    $client = OpenAI::factory()->withApiKey('test-key')->withHttpClient(new HttpClient(['handler' => $handler]))->make();
    $result = $client->realtime()->createClientSecret($parameters);

    expect($history)->toHaveCount(1);

    $request = $history[0]['request'];
    expect($request->getMethod())->toBe('POST')
        ->and((string) $request->getUri())->toBe('https://api.openai.com/v1/realtime/client_secrets')
        ->and($request->getHeaderLine('Content-Type'))->toBe('application/json')
        ->and($request->getHeaderLine('Authorization'))->toBe('Bearer test-key')
        ->and($request->hasHeader('OpenAI-Beta'))->toBeFalse()
        ->and((string) $request->getBody())->toBe(json_encode((object) $parameters, JSON_THROW_ON_ERROR));

    expect($result)->toBeInstanceOf(ClientSecretResponse::class)
        ->and($result->value)->toBe('ek_temporary')
        ->and($result->expiresAt)->toBe(1756310470)
        ->and($result->session)->toBe($session)
        ->and($result['session'])->toBe($session)
        ->and($result->toArray())->toBe($answer)
        ->and($result->meta()->requestId)->toBe('req_realtime');
})->with([
    'defaults' => [[], ClientSecretResponseFixture::ATTRIBUTES['session']],
    'realtime voice' => [
        [
            'expires_after' => ['anchor' => 'created_at', 'seconds' => 60],
            'session' => ['type' => 'realtime', 'model' => 'gpt-realtime-2.1', 'audio' => ['output' => ['voice' => 'alloy']]],
        ],
        ClientSecretResponseFixture::ATTRIBUTES['session'],
    ],
    'transcription' => [
        [
            'session' => [
                'type' => 'transcription',
                'audio' => ['input' => ['transcription' => ['model' => 'gpt-realtime-whisper'], 'turn_detection' => null]],
            ],
        ],
        [
            'id' => 'sess_transcription',
            'object' => 'realtime.transcription_session',
            'type' => 'transcription',
            'audio' => ['input' => ['transcription' => ['model' => 'gpt-realtime-whisper'], 'turn_detection' => null]],
        ],
    ],
]);

test('token', function () {
    $client = mockClient('POST', 'realtime/sessions', [], Response::from(sessionResponseResource(), metaHeaders()));

    $result = $client->realtime()->token();

    expect($result)
        ->toBeInstanceOf(SessionResponse::class)
        ->clientSecret->value->toBe('ek_secret_123');
});

test('transcription token', function () {
    $client = mockClient('POST', 'realtime/transcription_sessions', [], Response::from(transcriptionSessionResponseResource(), metaHeaders()));

    $result = $client->realtime()->transcribeToken();

    expect($result)
        ->toBeInstanceOf(TranscriptionSessionResponse::class)
        ->clientSecret->value->toBe('ek_secret_345');
});
