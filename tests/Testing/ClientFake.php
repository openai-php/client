<?php

use OpenAI\Resources\Completions;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Testing\ClientFake;
use PHPUnit\Framework\ExpectationFailedException;

it('returns a fake response', function () {
    $fake = new ClientFake([
        CreateResponse::fake([
            'choices' => [
                [
                    'text' => 'awesome!',
                ],
            ],
        ]),
    ]);

    $completion = $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    expect($completion['choices'][0]['text'])->toBe('awesome!');
});

it('throws fake exceptions', function () {
    $fake = new ClientFake([
        new \OpenAI\Exceptions\ErrorException([
            'message' => 'The model `gpt-1` does not exist',
            'type' => 'invalid_request_error',
            'code' => null,
        ]),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);
})->expectExceptionMessage('The model `gpt-1` does not exist');

it('throws an exception if there is no more fake response', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);
})->expectExceptionMessage('No fake responses left');

it('allows to add more responses', function () {
    $fake = new ClientFake([
        CreateResponse::fake([
            'id' => 'cmpl-1',
        ]),
    ]);

    $completion = $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    expect($completion)
        ->id->toBe('cmpl-1');

    $fake->addResponses([
        CreateResponse::fake([
            'id' => 'cmpl-2',
        ]),
    ]);

    $completion = $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    expect($completion)
        ->id->toBe('cmpl-2');
});

it('asserts a request was sent', function () {
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

it('throws an exception if a request was not sent', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->assertSent(Completions::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-3.5-turbo-instruct' &&
            $parameters['prompt'] === 'PHP is ';
    });
})->expectException(ExpectationFailedException::class);

it('asserts a request was sent on the resource', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->completions()->assertSent(function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-3.5-turbo-instruct' &&
            $parameters['prompt'] === 'PHP is ';
    });
});

it('asserts a request was sent n times', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->assertSent(Completions::class, 2);
});

it('throws an exception if a request was not sent n times', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->assertSent(Completions::class, 2);
})->expectException(ExpectationFailedException::class);

it('asserts a request was not sent', function () {
    $fake = new ClientFake();

    $fake->assertNotSent(Completions::class);
});

it('throws an exception if an unexpected request was sent', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->assertNotSent(Completions::class);
})->expectException(ExpectationFailedException::class);

it('asserts a request was not sent on the resource', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->completions()->assertNotSent();
});

it('asserts no request was sent', function () {
    $fake = new ClientFake();

    $fake->assertNothingSent();
});

it('throws an exception if any request was sent when non was expected', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is ',
    ]);

    $fake->assertNothingSent();
})->expectException(ExpectationFailedException::class);
