<?php

use OpenAI\Resources\Realtime;
use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;
use OpenAI\Testing\ClientFake;

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
