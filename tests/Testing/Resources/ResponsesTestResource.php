<?php

use OpenAI\Resources\Responses;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Testing\ClientFake;

it('records a response create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->responses()->create([
        'model' => 'gpt-4o-mini',
        'tools' => [
            [
                'type' => 'web_search_preview'
            ]
        ],
        'input' => "what was a positive news story from today?"
    ]);

    $fake->assertSent(Responses::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-4o-mini' &&
            $parameters['tools'] === [
                [
                    'type' => 'web_search_preview'
                ]
            ] &&
            $parameters['input'] === "what was a positive news story from today?";
    });
});

it('records a response retrieve request', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake(),
    ]);

    $fake->responses()->retrieve('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    $fake->assertSent(Responses::class, function ($method, $responseId) {
        return $method === 'retrieve' &&
            $responseId === 'asst_SMzoVX8XmCZEg1EbMHoAm8tc';
    });
});

it('records a response delete request', function () {
    $fake = new ClientFake([
        DeleteResponse::fake(),
    ]);

    $fake->responses()->delete('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    $fake->assertSent(Responses::class, function ($method, $responseId) {
        return $method === 'delete' &&
            $responseId === 'asst_SMzoVX8XmCZEg1EbMHoAm8tc';
    });
});

it('records a response list request', function () {
    $fake = new ClientFake([
        ListInputItems::fake(),
    ]);

    $fake->responses()->list('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    $fake->assertSent(Responses::class, function ($method, $responseId) {
        return $method === 'list' &&
            $responseId === 'asst_SMzoVX8XmCZEg1EbMHoAm8tc';
    });
});
