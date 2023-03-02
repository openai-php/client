<?php

use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\Responses\Audio\TranslationResponseSegment;

test('from json', function () {
    $Translation = TranslationResponse::from(audioTranslationJson());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');
});

test('from verbose json', function () {
    $Translation = TranslationResponse::from(audioTranslationVerboseJson());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBe('translate')
        ->language->toBe('english')
        ->duration->toBe(2.95)
        ->segments->toBeArray()
        ->segments->toHaveCount(1)
        ->segments->each->toBeInstanceOf(TranslationResponseSegment::class)
        ->text->toBe('Hello, how are you?');
});

test('from text', function () {
    $Translation = TranslationResponse::from(audioTranslationText());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');
});

test('from srt', function () {
    $Translation = TranslationResponse::from(audioTranslationSrt());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
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
    $Translation = TranslationResponse::from(audioTranslationVtt());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
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
    $Translation = TranslationResponse::from(audioTranslationJson());

    expect($Translation['text'])->toBe('Hello, how are you?');
});

test('to array', function () {
    $Translation = TranslationResponse::from(audioTranslationVerboseJson());

    expect($Translation->toArray())
        ->toBeArray()
        ->toBe(audioTranslationVerboseJson());
});
