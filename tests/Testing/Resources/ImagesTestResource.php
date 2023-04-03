<?php

use OpenAI\Resources\Images;
use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\Testing\ClientFake;

it('records a images create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->images()->create([
        'prompt' => 'A cute baby sea otter',
    ]);

    $fake->assertSent(Images::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['prompt'] === 'A cute baby sea otter';
    });
});

it('records a images edit request', function () {
    $fake = new ClientFake([
        EditResponse::fake(),
    ]);

    $fake->images()->edit([
        'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
    ]);

    $fake->assertSent(Images::class, function ($method, $parameters) {
        return $method === 'edit' &&
            $parameters['prompt'] === 'A sunlit indoor lounge area with a pool containing a flamingo';
    });
});

it('records a images variation request', function () {
    $fake = new ClientFake([
        VariationResponse::fake(),
    ]);

    $fake->images()->variation([
        'size' => '256x256',
    ]);

    $fake->assertSent(Images::class, function ($method, $parameters) {
        return $method === 'variation' &&
            $parameters['size'] === '256x256';
    });
});
