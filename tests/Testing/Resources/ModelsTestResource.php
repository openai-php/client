<?php

use OpenAI\Resources\Models;
use OpenAI\Responses\Models\DeleteResponse;
use OpenAI\Responses\Models\ListResponse;
use OpenAI\Responses\Models\RetrieveResponse;
use OpenAI\Testing\ClientFake;

it('records a model retrieve request', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake(),
    ]);

    $fake->models()->retrieve('text-davinci-003');

    $fake->assertSent(Models::class, function ($method, $parameters) {
        return $method === 'retrieve' &&
            $parameters === 'text-davinci-003';
    });
});

it('records a model delete request', function () {
    $fake = new ClientFake([
        DeleteResponse::fake(),
    ]);

    $fake->models()->delete('curie:ft-acmeco-2021-03-03-21-44-20');

    $fake->assertSent(Models::class, function ($method, $parameters) {
        return $method === 'delete' &&
            $parameters === 'curie:ft-acmeco-2021-03-03-21-44-20';
    });
});

it('records a model list request', function () {
    $fake = new ClientFake([
        ListResponse::fake(),
    ]);

    $fake->models()->list();

    $fake->assertSent(Models::class, function ($method) {
        return $method === 'list';
    });
});
