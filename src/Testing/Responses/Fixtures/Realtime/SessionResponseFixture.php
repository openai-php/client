<?php

namespace OpenAI\Testing\Responses\Fixtures\Realtime;

final class SessionResponseFixture
{
    public const ATTRIBUTES = [
        'client_secret' => [
            'expires_at' => 1735680000,
            'value' => 'ek_secret_123',
        ],
        'input_audio_format' => 'pcm16',
        'input_audio_transcription' => null,
        'instructions' => 'Your knowledge cutoff is 2023-10. You are a helpful assistant.',
        'max_response_output_tokens' => 'inf',
        'modalities' => [
            'audio',
            'text',
        ],
        'output_audio_format' => 'pcm16',
        'temperature' => 0.7,
        'tool_choice' => 'auto',
        'tools' => [],
        'turn_detection' => [
            'prefix_padding_ms' => 100,
            'silence_duration_ms' => 500,
            'threshold' => 0.5,
            'type' => 'server_vad',
        ],
        'voice' => 'alloy',
    ];
}
