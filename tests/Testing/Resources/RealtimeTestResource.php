<?php

use OpenAI\Resources\Realtime;
use OpenAI\Responses\Realtime\ClientSecretResponse;
use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;
use OpenAI\Testing\ClientFake;

it('records a realtime client secret request', function () {
    $response = ClientSecretResponse::fake(['value' => 'ek_fake']);
    $fake = new ClientFake([$response]);
    $parameters = ['session' => ['type' => 'realtime', 'model' => 'gpt-realtime-2.1']];

    expect($fake->realtime()->createClientSecret($parameters))->toBe($response)
        ->and($response->value)->toBe('ek_fake');

    $fake->assertSent(Realtime::class, fn ($method, $arguments) => $method === 'createClientSecret' && $arguments === $parameters);
});

it('records a realtime token request', function () {
    $fake = new ClientFake([
        SessionResponse::fake(),
    ]);

    $fake->realtime()->token();

    $fake->assertSent(Realtime::class, function ($method) {
        return $method === 'token';
    });
});

it('records a realtime token transcription request', function () {
    $fake = new ClientFake([
        TranscriptionSessionResponse::fake(),
    ]);

    $fake->realtime()->transcribeToken();

    $fake->assertSent(Realtime::class, function ($method) {
        return $method === 'transcribeToken';
    });
});
