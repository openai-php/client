<?php

use OpenAI\Resources\ThreadsRuns;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Testing\ClientFake;

it('records a thread run create request', function () {
    $fake = new ClientFake([
        ThreadRunResponse::fake(),
    ]);

    $fake->threads()->runs()->create(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        parameters: [
            'assistant_id' => 'asst_gxzBkD1wkKEloYqZ410pT5pd',
        ],
    );

    $fake->assertSent(ThreadsRuns::class, function ($method, $threadId, $parameters) {
        return $method === 'create' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $parameters['assistant_id'] === 'asst_gxzBkD1wkKEloYqZ410pT5pd';
    });
});

it('records a thread run retrieve request', function () {
    $fake = new ClientFake([
        ThreadRunResponse::fake(),
    ]);

    $fake->threads()->runs()->retrieve(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        runId: 'run_4RCYyYzX9m41WQicoJtUQAb8',
    );

    $fake->assertSent(ThreadsRuns::class, function ($method, $threadId, $runId) {
        return $method === 'retrieve' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $runId === 'run_4RCYyYzX9m41WQicoJtUQAb8';
    });
});

it('records a thread run modify request', function () {
    $fake = new ClientFake([
        ThreadRunResponse::fake(),
    ]);

    $fake->threads()->runs()->modify(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        runId: 'run_4RCYyYzX9m41WQicoJtUQAb8',
        parameters: [
            'metadata' => [
                'name' => 'My new run name',
            ],
        ],
    );

    $fake->assertSent(ThreadsRuns::class, function ($method, $threadId, $runId, $parameters) {
        return $method === 'modify' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $runId === 'run_4RCYyYzX9m41WQicoJtUQAb8' &&
            $parameters['metadata'] === [
                'name' => 'My new run name',
            ];
    });
});

it('records a thread run cancel request', function () {
    $fake = new ClientFake([
        ThreadRunResponse::fake(),
    ]);

    $fake->threads()->runs()->cancel(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        runId: 'run_4RCYyYzX9m41WQicoJtUQAb8',
    );

    $fake->assertSent(ThreadsRuns::class, function ($method, $threadId, $runId) {
        return $method === 'cancel' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $runId === 'run_4RCYyYzX9m41WQicoJtUQAb8';
    });
});

it('records a thread run submit tool outputs request', function () {
    $fake = new ClientFake([
        ThreadRunResponse::fake(),
    ]);

    $fake->threads()->runs()->submitToolOutputs(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        runId: 'run_4RCYyYzX9m41WQicoJtUQAb8',
        parameters: [
            'tool_outputs' => [
                [
                    'tool_call_id' => 'call_KSg14X7kZF2WDzlPhpQ168Mj',
                    'output' => '12',
                ],
            ],
        ]
    );

    $fake->assertSent(ThreadsRuns::class, function ($method, $threadId, $runId, $parameters) {
        return $method === 'submitToolOutputs' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $runId === 'run_4RCYyYzX9m41WQicoJtUQAb8' &&
            $parameters['tool_outputs'] === [
                [
                    'tool_call_id' => 'call_KSg14X7kZF2WDzlPhpQ168Mj',
                    'output' => '12',
                ],
            ];
    });
});

it('records a thread run list request', function () {
    $fake = new ClientFake([
        ThreadRunListResponse::fake(),
    ]);

    $fake->threads()->runs()->list(
        threadId: 'thread_tKFLqzRN9n7MnyKKvc1Q7868',
        parameters: [
            'limit' => 10,
        ],
    );

    $fake->assertSent(ThreadsRuns::class, function ($method, $threadId, $parameters) {
        return $method === 'list' &&
            $threadId === 'thread_tKFLqzRN9n7MnyKKvc1Q7868' &&
            $parameters['limit'] === 10;
    });
});
