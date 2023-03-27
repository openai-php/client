<?php

use OpenAI\Resources\FineTunes;
use OpenAI\Responses\FineTunes\ListEventsResponse;
use OpenAI\Responses\FineTunes\ListResponse;
use OpenAI\Responses\FineTunes\RetrieveResponse;
use OpenAI\Responses\FineTunes\RetrieveStreamedResponseEvent;
use OpenAI\Testing\ClientFake;

it('records a fine tunes create request', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake(),
    ]);

    $fake->fineTunes()->create([
        'model' => 'curie',
        'training_file' => 'file-ajSREls59WBbvgSzJSVWxMCB',
    ]);

    $fake->assertSent(FineTunes::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'curie' &&
            $parameters['training_file'] === 'file-ajSREls59WBbvgSzJSVWxMCB';
    });
});

it('records a fine tunes retrieve request', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake(),
    ]);

    $fake->fineTunes()->retrieve('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

    $fake->assertSent(FineTunes::class, function ($method, $parameters) {
        return $method === 'retrieve' &&
            $parameters === 'ft-AF1WoRqd3aJAHsqc9NY7iL8F';
    });
});

it('records a fine tunes cancel request', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake(),
    ]);

    $fake->fineTunes()->cancel('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

    $fake->assertSent(FineTunes::class, function ($method, $parameters) {
        return $method === 'cancel' &&
            $parameters === 'ft-AF1WoRqd3aJAHsqc9NY7iL8F';
    });
});

it('records a fine tunes list request', function () {
    $fake = new ClientFake([
        ListResponse::fake(),
    ]);

    $fake->fineTunes()->list();

    $fake->assertSent(FineTunes::class, function ($method) {
        return $method === 'list';
    });
});

it('records a fine tunes list events request', function () {
    $fake = new ClientFake([
        ListEventsResponse::fake(),
    ]);

    $fake->fineTunes()->listEvents('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

    $fake->assertSent(FineTunes::class, function ($method, $parameters) {
        return $method === 'listEvents' &&
            $parameters === 'ft-AF1WoRqd3aJAHsqc9NY7iL8F';
    });
});

it('records a streamed fine tunes list events request', function () {
    $fake = new ClientFake([
        RetrieveStreamedResponseEvent::fake(),
    ]);

    $fake->fineTunes()->listEventsStreamed('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

    $fake->assertSent(FineTunes::class, function ($method, $parameters) {
        return $method === 'listEventsStreamed' &&
            $parameters === 'ft-AF1WoRqd3aJAHsqc9NY7iL8F';
    });
});
