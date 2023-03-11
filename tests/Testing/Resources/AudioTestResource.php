<?php

use OpenAI\Resources\Audio;
use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\Testing\ClientFake;

it('records an audio transcription request', function () {
    $fake = new ClientFake([
        TranscriptionResponse::fake(),
    ]);

    $fake->audio()->transcribe([
        'model' => 'whisper-1',
        'response_format' => 'verbose_json',
    ]);

    $fake->assertSent(Audio::class, function ($method, $parameters) {
        return $method === 'transcribe' &&
            $parameters['model'] === 'whisper-1' &&
            $parameters['response_format'] === 'verbose_json';
    });
});

it('records an audio translation request', function () {
    $fake = new ClientFake([
        TranslationResponse::fake(),
    ]);

    $fake->audio()->translate([
        'model' => 'whisper-1',
        'response_format' => 'verbose_json',
    ]);

    $fake->assertSent(Audio::class, function ($method, $parameters) {
        return $method === 'translate' &&
            $parameters['model'] === 'whisper-1' &&
            $parameters['response_format'] === 'verbose_json';
    });
});
