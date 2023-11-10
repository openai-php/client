<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolCodeInterpreter;

test('from', function () {
    $result = ThreadRunResponse::from(threadRunResource(), meta());

    expect($result)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699621735)
        ->threadId->toBe('thread_EKt7MjGOC6bwKWmenQv5VD6r')
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->status->toBe('queued')
        ->startedAt->toBeNull()
        ->expiresAt->toBe(1699622335)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()
        ->tools->tohaveCount(1)
        ->tools->{0}->toBeInstanceOf(ThreadRunResponseToolCodeInterpreter::class)
        ->fileIds->toBe(['file-6EsV79Y261TEmi0PY5iHbZdS'])
        ->metadata->toBe([])
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ThreadRunResponse::from(threadRunResource(), meta());

    expect($result['id'])
        ->toBe('run_4RCYyYzX9m41WQicoJtUQAb8');
});

test('to array', function () {
    $result = ThreadRunResponse::from(threadRunResource(), meta());

    expect($result->toArray())
        ->toBe(threadRunResource());
});

test('fake', function () {
    $response = ThreadRunResponse::fake();

    expect($response)
        ->id->toBe('run_4RCYyYzX9m41WQicoJtUQAb8');
});

test('fake with override', function () {
    $response = ThreadRunResponse::fake([
        'id' => 'run_1234',
    ]);

    expect($response)
        ->id->toBe('run_1234');
});
