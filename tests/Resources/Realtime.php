<?php

use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;

test('token', function () {
    $client = mockClient('POST', 'realtime/sessions', [], \OpenAI\ValueObjects\Transporter\Response::from(sessionResponseResource(), metaHeaders()));

    $result = $client->realtime()->token();

    expect($result)
        ->toBeInstanceOf(SessionResponse::class)
        ->clientSecret->value->toBe('ek_secret_123');
});

test('transcription token', function () {
    $client = mockClient('POST', 'realtime/transcription_sessions', [], \OpenAI\ValueObjects\Transporter\Response::from(transcriptionSessionResponseResource(), metaHeaders()));

    $result = $client->realtime()->transcribeToken();

    expect($result)
        ->toBeInstanceOf(TranscriptionSessionResponse::class)
        ->clientSecret->value->toBe('ek_secret_345');
});
