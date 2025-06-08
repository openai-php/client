<?php

use OpenAI\Responses\Realtime\Session\ClientSecret;
use OpenAI\Responses\Realtime\Session\TurnDetection;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;

test('from', function () {
    $response = TranscriptionSessionResponse::from(transcriptionSessionResponseResource());

    expect($response)
        ->toBeInstanceOf(TranscriptionSessionResponse::class)
        ->clientSecret->toBeInstanceOf(ClientSecret::class)
        ->inputAudioFormat->toBe('pcm16')
        ->inputAudioTranscription->toBeNull()
        ->modalities->toBeNull()
        ->turnDetection->toBeInstanceOf(TurnDetection::class);
});
