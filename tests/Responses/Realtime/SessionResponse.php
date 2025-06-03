<?php

use OpenAI\Responses\Realtime\Session\ClientSecret;
use OpenAI\Responses\Realtime\Session\TurnDetection;
use OpenAI\Responses\Realtime\SessionResponse;

test('from', function () {
    $response = SessionResponse::from(sessionResponseResource());

    expect($response)
        ->toBeInstanceOf(SessionResponse::class)
        ->clientSecret->toBeInstanceOf(ClientSecret::class)
        ->inputAudioFormat->toBe('pcm16')
        ->inputAudioTranscription->toBeNull()
        ->instructions->toBe('Your knowledge cutoff is 2023-10. You are a helpful assistant.')
        ->maxResponseOutputTokens->toBe('inf')
        ->modalities->toBe(['audio', 'text'])
        ->outputAudioFormat->toBe('pcm16')
        ->temperature->toBe(0.7)
        ->toolChoice->toBe('auto')
        ->tools->toBeArray()
        ->turnDetection->toBeInstanceOf(TurnDetection::class)
        ->voice->toBe('alloy');
});
