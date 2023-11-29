<?php

use OpenAI\Resources\Assistants;
use OpenAI\Responses\Assistants\AssistantDeleteResponse;
use OpenAI\Responses\Assistants\AssistantListResponse;
use OpenAI\Responses\Assistants\AssistantResponse;
use OpenAI\Testing\ClientFake;

it('records an assistant create request', function () {
    $fake = new ClientFake([
        AssistantResponse::fake(),
    ]);

    $fake->assistants()->create([
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'name' => 'Math Tutor',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'model' => 'gpt-4',
    ]);

    $fake->assertSent(Assistants::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['instructions'] === 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.' &&
            $parameters['name'] === 'Math Tutor' &&
            $parameters['tools'] === [
                [
                    'type' => 'code_interpreter',
                ],
            ] &&
            $parameters['model'] === 'gpt-4';
    });
});

it('records an assistant retrieve request', function () {
    $fake = new ClientFake([
        AssistantResponse::fake(),
    ]);

    $fake->assistants()->retrieve('asst_gxzBkD1wkKEloYqZ410pT5pd');

    $fake->assertSent(Assistants::class, function ($method, $assistantId) {
        return $method === 'retrieve' &&
            $assistantId === 'asst_gxzBkD1wkKEloYqZ410pT5pd';
    });
});

it('records an assistant modify request', function () {
    $fake = new ClientFake([
        AssistantResponse::fake(),
    ]);

    $fake->assistants()->modify('asst_gxzBkD1wkKEloYqZ410pT5pd', [
        'name' => 'New Math Tutor',
    ]);

    $fake->assertSent(Assistants::class, function ($method, $assistantId, $parameters) {
        return $method === 'modify' &&
            $assistantId === 'asst_gxzBkD1wkKEloYqZ410pT5pd' &&
            $parameters['name'] === 'New Math Tutor';
    });
});

it('records an assistant delete request', function () {
    $fake = new ClientFake([
        AssistantDeleteResponse::fake(),
    ]);

    $fake->assistants()->delete('asst_gxzBkD1wkKEloYqZ410pT5pd');

    $fake->assertSent(Assistants::class, function ($method, $assistantId) {
        return $method === 'delete' &&
            $assistantId === 'asst_gxzBkD1wkKEloYqZ410pT5pd';
    });
});

it('records an assistant list request', function () {
    $fake = new ClientFake([
        AssistantListResponse::fake(),
    ]);

    $fake->assistants()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(Assistants::class, function ($method) {
        return $method === 'list';
    });
});
