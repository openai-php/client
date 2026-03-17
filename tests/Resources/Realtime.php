<?php

use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;
use OpenAI\ValueObjects\Transporter\Response;

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
