<?php

use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranscriptionResponseSegment;
use OpenAI\Responses\Meta\MetaInformation;

test('from json', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionJson(), meta());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from verbose json', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionVerboseJson(), meta());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBe('transcribe')
        ->language->toBe('english')
        ->duration->toBe(2.95)
        ->segments->toBeArray()
        ->segments->toHaveCount(1)
        ->segments->each->toBeInstanceOf(TranscriptionResponseSegment::class)
        ->text->toBe('Hello, how are you?')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from text', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionText(), meta());

    expect($transcription)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from srt', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionSrt(), meta());

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
        )
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from vtt', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionVtt(), meta());

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
        )
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionJson(), meta());

    expect($transcription['text'])->toBe('Hello, how are you?');
});

test('to array', function () {
    $transcription = TranscriptionResponse::from(audioTranscriptionVerboseJson(), meta());

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
