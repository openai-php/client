<?php

namespace OpenAI\Testing\Responses\Fixtures\Realtime;

final class TranscriptionSessionResponseFixture
{
    public const ATTRIBUTES = [
        'client_secret' => [
            'expires_at' => 1735680000,
            'value' => 'ek_secret_123',
        ],
        'input_audio_format' => 'pcm16',
        'input_audio_transcription' => null,
        'modalities' => null,
        'turn_detection' => [
            'prefix_padding_ms' => 300,
            'silence_duration_ms' => 200,
            'threshold' => 0.5,
            'type' => 'server_vad',
        ],
    ];
}
