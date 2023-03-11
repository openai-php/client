<?php

use OpenAI\Resources\Chat;
use OpenAI\Responses\Chat\CreateResponse;
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
