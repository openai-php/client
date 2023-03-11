<?php

use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranscriptionResponseSegment;

test('from json', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionJson());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');
});

test('from verbose json', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionVerboseJson());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBe('transcribe')
        ->language->toBe('english')
        ->duration->toBe(2.95)
        ->segments->toBeArray()
        ->segments->toHaveCount(1)
        ->segments->each->toBeInstanceOf(TranscriptionResponseSegment::class)
        ->text->toBe('Hello, how are you?');
});

test('from text', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionText());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');
});

test('from srt', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionSrt());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe(<<<'SRT'
1
00:00:00,000 --> 00:00:04,000
Hello, how are you?

SRT
        );
});

test('from vtt', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionVtt());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe(<<<'VTT'
WEBVTT

00:00:00.000 --> 00:00:04.000
Hello, how are you?

VTT
        );
});

test('as array accessible', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionJson());

    expect($transcription['text'])->toBe('Hello, how are you?');
});

test('to array', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionVerboseJson());

    expect($transcription->toArray())
        ->toBeArray()
        ->toBe(audioTranscriptionVerboseJson());
});

test('fake', function () {
    $response = TranscriptionResponse::fake();

    expect($response)
        ->language->toBe('english');
});

test('fake with override', function () {
    $response = TranscriptionResponse::fake([
        'language' => 'german',
    ]);

    expect($response)
        ->language->toBe('german');
});
