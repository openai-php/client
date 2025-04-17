<?php

use OpenAI\Resources\Responses;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Testing\ClientFake;
use PHPUnit\Framework\ExpectationFailedException;

it('returns a fake response for create', function () {
    $fake = new ClientFake([
        CreateResponse::fake([
            'model' => 'gpt-4o',
            'tools' => [['type' => 'web_search_preview']],
            'input' => 'what was a positive news story from today?',
        ]),
    ]);

    $response = $fake->responses()->create([
        'model' => 'gpt-4o',
        'tools' => [['type' => 'web_search_preview']],
        'input' => 'what was a positive news story from today?',
    ]);

    expect($response['model'])->toBe('gpt-4o');
    expect($response['tools'][0]['type'])->toBe('web_search_preview');
});

it('returns a fake response for retrieve', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake([
            'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        ]),
    ]);

    $response = $fake->responses()->retrieve('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    expect($response)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response');
});

it('returns a fake response for delete', function () {
    $fake = new ClientFake([
        DeleteResponse::fake(),
    ]);

    $response = $fake->responses()->delete('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    expect($response)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->deleted->toBeTrue();
});

it('returns a fake response for list', function () {
    $fake = new ClientFake([
        ListInputItems::fake(),
    ]);

    $response = $fake->responses()->list('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    expect($response->data)->toBeArray();
});

it('asserts a create request was sent', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->responses()->create([
        'model' => 'gpt-4o',
        'tools' => [['type' => 'web_search_preview']],
        'input' => 'what was a positive news story from today?',
    ]);

    $fake->assertSent(Responses::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-4o' &&
            $parameters['tools'][0]['type'] === 'web_search_preview' &&
            $parameters['input'] === 'what was a positive news story from today?';
    });
});

it('asserts a retrieve request was sent', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake(),
    ]);

    $fake->responses()->retrieve('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    $fake->assertSent(Responses::class, function ($method, $responseId) {
        return $method === 'retrieve' &&
            $responseId === 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c';
    });
});

it('asserts a delete request was sent', function () {
    $fake = new ClientFake([
        DeleteResponse::fake(),
    ]);

    $fake->responses()->delete('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    $fake->assertSent(Responses::class, function ($method, $responseId) {
        return $method === 'delete' &&
            $responseId === 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c';
    });
});

it('asserts a list request was sent', function () {
    $fake = new ClientFake([
        ListInputItems::fake(),
    ]);

    $fake->responses()->list('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    $fake->assertSent(Responses::class, function ($method, $responseId) {
        return $method === 'list' &&
            $responseId === 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c';
    });
});

it('throws an exception if there are no more fake responses', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->responses()->create([
        'model' => 'gpt-4o',
        'tools' => [
            [
                'type' => 'web_search_preview',
            ],
        ],
        'input' => 'what was a positive news story from today?',
    ]);

    $fake->responses()->create([
        'model' => 'gpt-4o',
        'tools' => [
            [
                'type' => 'web_search_preview',
            ],
        ],
        'input' => 'what was a positive news story from today?',
    ]);
})->expectExceptionMessage('No fake responses left');

it('throws an exception if a request was not sent', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->assertSent(Responses::class, function ($method, $parameters) {
        return $method === 'create';
    });
})->expectException(ExpectationFailedException::class);
