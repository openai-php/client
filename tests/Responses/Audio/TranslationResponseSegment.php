<?php

use OpenAI\Responses\Audio\TranslationResponseSegment;

test('from', function () {
    $result = TranslationResponseSegment::from(audioTranslationVerboseJson()['segments'][0]);

    expect($result)
        ->toBeInstanceOf(TranslationResponseSegment::class)
        ->id->toBe(0)
        ->seek->toBe(0)
        ->start->toBe(0.0)
        ->end->toBe(4.0)
        ->text->toBe(' Hello, how are you?')
        ->tokens->toBeArray()
        ->tokens->toHaveCount(8)
        ->tokens->toBe([50364, 2425, 11, 577, 366, 291, 30, 50564])
        ->temperature->toBe(0.0)
        ->avgLogprob->toBe(-0.45045216878255206)
        ->compressionRatio->toBe(0.7037037037037037)
        ->noSpeechProb->toBe(0.1076972484588623)
        ->transient->toBeFalse();
});

test('to array', function () {
    $result = TranslationResponseSegment::from(audioTranslationVerboseJson()['segments'][0]);

    expect($result->toArray())
        ->toBe(audioTranslationVerboseJson()['segments'][0]);
});

test('transient parameter may not returned', function () {
    $data = audioTranslationVerboseJson()['segments'][0];
    unset($data['transient']);

    $result = TranslationResponseSegment::from($data);

    expect($result)
        ->toBeInstanceOf(TranslationResponseSegment::class)
        ->id->toBe(0)
        ->seek->toBe(0)
        ->start->toBe(0.0)
        ->end->toBe(4.0)
        ->text->toBe(' Hello, how are you?')
        ->tokens->toBeArray()
        ->tokens->toHaveCount(8)
        ->tokens->toBe([50364, 2425, 11, 577, 366, 291, 30, 50564])
        ->temperature->toBe(0.0)
        ->avgLogprob->toBe(-0.45045216878255206)
        ->compressionRatio->toBe(0.7037037037037037)
        ->noSpeechProb->toBe(0.1076972484588623)
        ->transient->toBeNull();

    expect($result->toArray())
        ->toBe($data);
});
