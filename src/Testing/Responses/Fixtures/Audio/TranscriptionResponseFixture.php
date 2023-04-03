<?php

namespace OpenAI\Testing\Responses\Fixtures\Audio;

final class TranscriptionResponseFixture
{
    public const ATTRIBUTES = [
        'task' => 'transcribe',
        'language' => 'english',
        'duration' => 2.95,
        'segments' => [
            [
                'id' => 0,
                'seek' => 0,
                'start' => 0.0,
                'end' => 4.0,
                'text' => ' Hello, this is a fake transcription response.',
                'tokens' => [
                    50364,
                    2425,
                    11,
                    577,
                    366,
                    291,
                    30,
                    50564,
                ],
                'temperature' => 0.0,
                'avg_logprob' => -0.45045216878255206,
                'compression_ratio' => 0.7037037037037037,
                'no_speech_prob' => 0.1076972484588623,
                'transient' => false,
            ],
        ],
        'text' => 'Hello, how are you?',
    ];
}
