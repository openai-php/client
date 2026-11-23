<?php

use OpenAI\Resources\Chat;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\Chat\DeleteResponse;
use OpenAI\Responses\Chat\ListResponse;
use OpenAI\Testing\ClientFake;

it('records a chat create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello!'],
        ],
    ]);

    $fake->assertSent(Chat::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-3.5-turbo' &&
            $parameters['messages'][0]['role'] === 'user' &&
            $parameters['messages'][0]['content'] === 'Hello!';
    });
});

it('records a streamed create create request', function () {
    $fake = new ClientFake([
        CreateStreamedResponse::fake(),
    ]);

    $fake->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello!'],
        ],
    ]);

    $fake->assertSent(Chat::class, function ($method, $parameters) {
        return $method === 'createStreamed' &&
            $parameters['model'] === 'gpt-3.5-turbo' &&
            $parameters['messages'][0]['role'] === 'user' &&
            $parameters['messages'][0]['content'] === 'Hello!';
    });
});

it('records a chat list request', function () {
    $fake = new ClientFake([
        ListResponse::fake(),
    ]);

    $fake->chat()->list([
        'model' => 'gpt-4o',
    ]);

    $fake->assertSent(Chat::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['model'] === 'gpt-4o';
    });
});

it('records a chat retrieve request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->chat()->retrieve('chatcmpl-123');

    $fake->assertSent(Chat::class, function ($method, $completionId) {
        return $method === 'retrieve' &&
            $completionId === 'chatcmpl-123';
    });
});

it('records a chat update request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->chat()->update('chatcmpl-123', [
        'metadata' => ['topic' => 'greeting'],
    ]);

    $fake->assertSent(Chat::class, function ($method, $completionId, $parameters) {
        return $method === 'update' &&
            $completionId === 'chatcmpl-123' &&
            $parameters['metadata']['topic'] === 'greeting';
    });
});

it('records a chat delete request', function () {
    $fake = new ClientFake([
        DeleteResponse::fake(),
    ]);

    $fake->chat()->delete('chatcmpl-123');

    $fake->assertSent(Chat::class, function ($method, $completionId) {
        return $method === 'delete' &&
            $completionId === 'chatcmpl-123';
    });
});
