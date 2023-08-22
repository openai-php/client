<?php

use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranscriptionResponseSegment;
use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\Responses\Audio\TranslationResponseSegment;
use OpenAI\Responses\Meta\MetaInformation;

test('transcribe to text', function () {
    $client = mockClient('POST', 'audio/transcriptions', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'text',
    ], \OpenAI\ValueObjects\Transporter\Response::from(audioTranscriptionText(), metaHeaders()));

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

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('transcribe to json', function () {
    $client = mockClient('POST', 'audio/transcriptions', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'json',
    ], \OpenAI\ValueObjects\Transporter\Response::from(audioTranscriptionJson(), metaHeaders()));

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

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('transcribe to verbose json', function () {
    $client = mockClient('POST', 'audio/transcriptions', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'verbose_json',
    ], \OpenAI\ValueObjects\Transporter\Response::from(audioTranscriptionVerboseJson(), metaHeaders()));

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

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('translate to text', function () {
    $client = mockClient('POST', 'audio/translations', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'text',
    ], \OpenAI\ValueObjects\Transporter\Response::from(audioTranslationText(), metaHeaders()));

    $result = $client->audio()->translate([
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'text',
    ]);

    expect($result)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('translate to json', function () {
    $client = mockClient('POST', 'audio/translations', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'json',
    ], \OpenAI\ValueObjects\Transporter\Response::from(audioTranslationJson(), metaHeaders()));

    $result = $client->audio()->translate([
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'json',
    ]);

    expect($result)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBeNull()
        ->language->toBeNull()
        ->duration->toBeNull()
        ->segments->toBeEmpty()
        ->text->toBe('Hello, how are you?');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('translate to verbose json', function () {
    $client = mockClient('POST', 'audio/translations', [
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'verbose_json',
    ], \OpenAI\ValueObjects\Transporter\Response::from(audioTranslationVerboseJson(), metaHeaders()));

    $result = $client->audio()->translate([
        'file' => audioFileResource(),
        'model' => 'whisper-1',
        'response_format' => 'verbose_json',
    ]);

    expect($result)
        ->toBeInstanceOf(TranslationResponse::class)
        ->task->toBe('translate')
        ->language->toBe('english')
        ->duration->toBe(2.95)
        ->segments->toBeArray()
        ->segments->toHaveCount(1)
        ->segments->each->toBeInstanceOf(TranslationResponseSegment::class)
        ->text->toBe('Hello, how are you?');

    expect($result->segments[0])
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

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
