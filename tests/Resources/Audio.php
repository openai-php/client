<?php

use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranscriptionResponseSegment;

test('transcribe to text', function () {
    $client = mockClient('POST', 'audio/transcriptions', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'text',
    ], audioTranscriptionText());

    $result = $client->audio()->transcribe([
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'text',
    ]);

    expect($result)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');
});

test('transcribe to json', function () {
    $client = mockClient('POST', 'audio/transcriptions', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'json',
    ], audioTranscriptionJson());

    $result = $client->audio()->transcribe([
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'json',
    ]);

    expect($result)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');
});

test('transcribe to verbose json', function () {
    $client = mockClient('POST', 'audio/transcriptions', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'verbose_json',
    ], audioTranscriptionVerboseJson());

    $result = $client->audio()->transcribe([
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'verbose_json',
    ]);

    expect($result)
        ->toBeInstanceOf(TranscriptionResponse::class)
        ->task->toBe('transcribe')
        ->language->toBe('english')
        ->duration->toBe(2.95)
        ->segments->toBeArray()
        ->segments->toHaveCount(1)
        ->segments->each->toBeInstanceOf(TranscriptionResponseSegment::class)
        ->text->toBe('Hello, how are you?');

    expect($result->segments[0])
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
        ->transient->toBeFalse();
});
