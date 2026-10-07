<?php

use OpenAI\Resources\Decisions;
use OpenAI\Responses\Decisions\CreateResponse;
use OpenAI\Testing\ClientFake;

it('records a decisions create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->decisions()->create([
        'model' => 'gpt-6-luna',
        'input' => 'Hello',
        'questions' => [],
    ]);

    $fake->assertSent(Decisions::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-6-luna' &&
            $parameters['input'] === 'Hello';
    });
});
