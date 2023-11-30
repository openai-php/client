<?php

/**
 * @return array<string, mixed>
 */
function audioTranscriptionVerboseJson(): array
{
    return [
        'task' => 'transcribe',
        'language' => 'english',
        'duration' => 2.95,
        'segments' => [
            [
                'id' => 0,
                'seek' => 0,
                'start' => 0.0,
                'end' => 4.0,
                'text' => ' Hello, how are you?',
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

/**
 * @return array<string, string>
 */
function audioTranscriptionJson(): array
{
    return [
        'text' => 'Hello, how are you?',
    ];
}

function audioTranscriptionText(): string
{
    return 'Hello, how are you?';
}

function audioTranscriptionVtt(): string
{
    return <<<'VTT'
WEBVTT

00:00:00.000 --> 00:00:04.000
Hello, how are you?

VTT;
}

function audioTranscriptionSrt(): string
{
    return <<<'SRT'
1
00:00:00,000 --> 00:00:04,000
Hello, how are you?

SRT;
}

/**
 * @return array<string, mixed>
 */
function audioTranslationVerboseJson(): array
{
    return [
        'task' => 'translate',
        'language' => 'english',
        'duration' => 2.95,
        'segments' => [
            [
                'id' => 0,
                'seek' => 0,
                'start' => 0.0,
                'end' => 4.0,
                'text' => ' Hello, how are you?',
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

/**
 * @return array<string, string>
 */
function audioTranslationJson(): array
{
    return [
        'text' => 'Hello, how are you?',
    ];
}

function audioTranslationText(): string
{
    return 'Hello, how are you?';
}

function audioTranslationVtt(): string
{
    return <<<'VTT'
WEBVTT

00:00:00.000 --> 00:00:04.000
Hello, how are you?

VTT;
}

function audioTranslationSrt(): string
{
    return <<<'SRT'
1
00:00:00,000 --> 00:00:04,000
Hello, how are you?

SRT;
}

/**
 * @return resource
 */
function audioFileResource()
{
    return fopen(__DIR__.'/audio.mp3', 'r');
}

function audioFileContent(): string
{
    return file_get_contents(__DIR__.'/audio.mp3');
}

/**
 * @return resource
 */
function speechStream()
{
    return fopen(__DIR__.'/Streams/Speech.mp3', 'r');
}
