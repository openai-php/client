<?php

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('resp_67c9fdcecf488190bdd9a0409de3a1ec07b8b0ad4e5eb654');
});

test('from', function () {
    $response = CreateStreamedResponse::fake(responseCompletionSteamCreatedEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.created')
        ->response->toBeInstanceOf(CreateResponse::class)
        ->response->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});
