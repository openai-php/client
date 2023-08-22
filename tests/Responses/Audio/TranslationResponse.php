<?php

use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\Responses\Audio\TranslationResponseSegment;
use OpenAI\Responses\Meta\MetaInformation;

test('from json', function () {
    $Translation = TranslationResponse::from(audioTranslationJson(), meta());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from verbose json', function () {
    $Translation = TranslationResponse::from(audioTranslationVerboseJson(), meta());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBe('translate')
        ->language->toBe('english')
        ->duration->toBe(2.95)
        ->segments->toBeArray()
        ->segments->toHaveCount(1)
        ->segments->each->toBeInstanceOf(TranslationResponseSegment::class)
        ->text->toBe('Hello, how are you?')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from text', function () {
    $Translation = TranslationResponse::from(audioTranslationText(), meta());

    expect($Translation)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?')
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from srt', function () {
    $Translation = TranslationResponse::from(audioTranslationSrt(), meta());

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
        )
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from vtt', function () {
    $Translation = TranslationResponse::from(audioTranslationVtt(), meta());

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
        )
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $Translation = TranslationResponse::from(audioTranslationJson(), meta());

    expect($Translation['text'])->toBe('Hello, how are you?');
});

test('to array', function () {
    $Translation = TranslationResponse::from(audioTranslationVerboseJson(), meta());

    expect($Translation->toArray())
        ->toBeArray()
        ->toBe(audioTranslationVerboseJson());
});

test('fake', function () {
    $response = TranslationResponse::fake();

    expect($response)
        ->language->toBe('english');
});

test('fake with override', function () {
    $response = TranslationResponse::fake([
        'language' => 'german',
    ]);

    expect($response)
        ->language->toBe('german');
});
