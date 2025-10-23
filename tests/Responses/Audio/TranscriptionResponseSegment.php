<?php

use OpenAI\Responses\Audio\TranscriptionResponseSegment;

test('from', function () {
    $result = TranscriptionResponseSegment::from(audioTranscriptionVerboseJson()['segments'][0]);

    expect($result)
        ->toBeInstanceOf(TranscriptionResponseSegment::class)
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
        ->transient->toBeFalse()
        // Test that diarization-specific properties are null
        ->type->toBeNull()
        ->speaker->toBeNull();
});

test('from diarized', function () {
    $result = TranscriptionResponseSegment::from(audioTranscriptionDiarizedJson()['segments'][0]);

    expect($result)
        ->toBeInstanceOf(TranscriptionResponseSegment::class)
        ->id->toBe('seg_0')
        ->start->toBe(0.0)
        ->end->toBe(4.0)
        ->text->toBe(' Hello, how are you?')
        ->speaker->toBe('A')
        ->type->toBe('transcript.text.segment')
        // Test that non-diarization-specific properties are null
        ->tokens->toBeNull()
        ->seek->toBeNull()
        ->temperature->toBeNull()
        ->avgLogprob->toBeNull()
        ->compressionRatio->toBeNull()
        ->noSpeechProb->toBeNull()
        ->transient->toBeNull();
});

test('to array', function () {
    $result = TranscriptionResponseSegment::from(audioTranscriptionVerboseJson()['segments'][0]);

    expect($result->toArray())
        ->toBe(audioTranscriptionVerboseJson()['segments'][0]);
});

test('transient parameter may not returned', function () {
    $data = audioTranscriptionVerboseJson()['segments'][0];
    unset($data['transient']);

    $result = TranscriptionResponseSegment::from($data);

    expect($result)
        ->toBeInstanceOf(TranscriptionResponseSegment::class)
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
