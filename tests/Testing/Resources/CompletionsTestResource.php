<?php

use OpenAI\Resources\Completions;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Testing\ClientFake;

it('records a completions create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'text-davinci-003',
        'prompt' => 'PHP is ',
    ]);

    $fake->assertSent(Completions::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'text-davinci-003' &&
            $parameters['prompt'] === 'PHP is ';
    });
});
