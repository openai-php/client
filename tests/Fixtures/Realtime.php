<?php

/**
 * @return array<string, mixed>
 */
function sessionResponseResource(): array
{
    return [
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

/**
 * @return array<string, mixed>
 */
function transcriptionSessionResponseResource(): array
{
    return [
        'client_secret' => [
            'expires_at' => 1735680000,
            'value' => 'ek_secret_345',
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
