<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolCodeInterpreter;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs', [], Response::from(threadRunListResource(), metaHeaders()));

    $result = $client->threads()->runs()->list('thread_agvtHUGezjTCt4SKgQg0NJ2Y');

    expect($result)
        ->toBeInstanceOf(ThreadRunListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadRunResponse::class)
        ->firstId->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->lastId->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create', function () {
    $client = mockClient('POST', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs', [
        'assistant_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
    ], Response::from(threadRunResource(), metaHeaders()));

    $result = $client->threads()->runs()->create('thread_agvtHUGezjTCt4SKgQg0NJ2Y', [
        'assistant_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
    ]);

    expect($result)
        ->toBeInstanceOf(ThreadRunResponse::class)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699621735)
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->threadId->toBe('thread_EKt7MjGOC6bwKWmenQv5VD6r')
        ->status->toBe('queued')
        ->startedAt->toBeNull()
        ->expiresAt->toBe(1699622335)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(ThreadRunResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toHaveCount(1)
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('modify', function () {
    $client = mockClient('POST', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs/run_4RCYyYzX9m41WQicoJtUQAb8', [
        'metadata' => [
            'name' => 'My new run name',
        ],
    ], Response::from(threadRunResource(), metaHeaders()));

    $result = $client->threads()->runs()->modify('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'run_4RCYyYzX9m41WQicoJtUQAb8', [
        'metadata' => [
            'name' => 'My new run name',
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ThreadRunResponse::class)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699621735)
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->threadId->toBe('thread_EKt7MjGOC6bwKWmenQv5VD6r')
        ->status->toBe('queued')
        ->startedAt->toBeNull()
        ->expiresAt->toBe(1699622335)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(ThreadRunResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toHaveCount(1)
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs/run_4RCYyYzX9m41WQicoJtUQAb8', [], Response::from(threadRunResource(), metaHeaders()));

    $result = $client->threads()->runs()->retrieve('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'run_4RCYyYzX9m41WQicoJtUQAb8');

    expect($result)
        ->toBeInstanceOf(ThreadRunResponse::class)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699621735)
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->threadId->toBe('thread_EKt7MjGOC6bwKWmenQv5VD6r')
        ->status->toBe('queued')
        ->startedAt->toBeNull()
        ->expiresAt->toBe(1699622335)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(ThreadRunResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toHaveCount(1)
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('cancel', function () {
    $client = mockClient('POST', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs/run_4RCYyYzX9m41WQicoJtUQAb8/cancel', [], Response::from(threadRunResource(), metaHeaders()));

    $result = $client->threads()->runs()->cancel('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'run_4RCYyYzX9m41WQicoJtUQAb8');

    expect($result)
        ->toBeInstanceOf(ThreadRunResponse::class)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699621735)
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->threadId->toBe('thread_EKt7MjGOC6bwKWmenQv5VD6r')
        ->status->toBe('queued')
        ->startedAt->toBeNull()
        ->expiresAt->toBe(1699622335)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(ThreadRunResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toHaveCount(1)
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('submit tool outputs', function () {
    $client = mockClient('POST', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs/run_4RCYyYzX9m41WQicoJtUQAb8/submit_tool_outputs', [
        'tool_outputs' => [
            [
                'tool_call_id' => 'tool_1',
                'output' => 'This is the output of tool 1',
            ],
        ],
    ], Response::from(threadRunResource(), metaHeaders()));

    $result = $client->threads()->runs()->submitToolOutputs('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'run_4RCYyYzX9m41WQicoJtUQAb8', [
        'tool_outputs' => [
            [
                'tool_call_id' => 'tool_1',
                'output' => 'This is the output of tool 1',
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ThreadRunResponse::class)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699621735)
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->threadId->toBe('thread_EKt7MjGOC6bwKWmenQv5VD6r')
        ->status->toBe('queued')
        ->startedAt->toBeNull()
        ->expiresAt->toBe(1699622335)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()->toHaveCount(1)
        ->tools->each->toBeInstanceOf(ThreadRunResponseToolCodeInterpreter::class)
        ->fileIds->toBeArray()->toHaveCount(1)
        ->metadata->toBeArray()->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
