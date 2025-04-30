<?php

use OpenAI\Resources\Moderations;
use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Testing\ClientFake;

it('records a moderations create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->moderations()->create([
        'model' => 'text-moderation-latest',
        'input' => 'I want to k*** them.',
    ]);

    $fake->assertSent(Moderations::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'text-moderation-latest' &&
            $parameters['input'] === 'I want to k*** them.';
    });
});

it('records a multi-modal moderations create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->moderations()->create([
        'model' => 'text-moderation-omni',
        'input' => [
            [
                'type' => 'text',
                'text' => 'I want to k*** them.',
            ],
            [
                'type' => 'image_url',
                'image_url' => [
                    'url' => 'https://example.com/potentially-harmful-image.jpg',
                ],
            ],
        ],
    ]);

    $fake->assertSent(Moderations::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'text-moderation-omni' &&
            $parameters['input'][0]['type'] === 'text' &&
            $parameters['input'][0]['text'] === 'I want to k*** them.' &&
            $parameters['input'][1]['type'] === 'image_url' &&
            $parameters['input'][1]['image_url']['url'] === 'https://example.com/potentially-harmful-image.jpg';
    });
});
