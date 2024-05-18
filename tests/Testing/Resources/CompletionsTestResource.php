<?php

use OpenAI\Resources\Completions;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Responses\Completions\CreateStreamedResponse;
use OpenAI\Testing\ClientFake;

it('records a completions create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->assertSent(Completions::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-3.5-turbo-instruct' &&
            $parameters['prompt'] === 'PHP is ';
    });
});

it('records a streamed completions create request', function () {
    $fake = new ClientFake([
        CreateStreamedResponse::fake(),
    ]);

    $fake->completions()->createStreamed([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->assertSent(Completions::class, function ($method, $parameters) {
        return $method === 'createStreamed' &&
            $parameters['model'] === 'gpt-3.5-turbo-instruct' &&
            $parameters['prompt'] === 'PHP is ';
    });
});

it('records a streamed completions create request using GPT 4', function () {
    $fake = new ClientFake([
        CreateStreamedResponse::fake(),
    ]);

    $fake->completions()->createStreamed([
        'model' => 'gpt-4o',
        'messages' => [
            ['role' => 'system', 'content' => "PHP is "]
        ]
    ]);

    $fake->assertSent(Completions::class, function ($method, $parameters) {
        return $method === 'createStreamed' &&
            $parameters['model'] === 'gpt-4o' &&
            is_array($parameters['messages']) &&
            $parameters['messages'][0]['role'] === 'system' &&
            $parameters['messages'][0]['content'] === 'PHP is ';
    });
});
