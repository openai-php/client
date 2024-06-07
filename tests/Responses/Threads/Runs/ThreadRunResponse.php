<?php

use OpenAI\Responses\Assistants\AssistantResponseResponseFormat;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseFileSearch;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseIncompleteDetails;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolCodeInterpreter;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseToolFunction;
use OpenAI\Responses\Threads\Runs\ThreadRunResponseUsage;

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
        ->metadata->toBe([])
        ->usage->toBeNull()
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->incomplete_details->toBeNull()
        ->temperature->tobe(1.0)
        ->topP->toBe(1.0)
        ->maxPromptTokens->toBe(600)
        ->maxCompletionTokens->toBe(500)
        ->toolChoice->toBe('none')
        ->responseFormat->toBe('auto');
});

test('from json object output', function () {
    $result = ThreadRunResponse::from(threadRunWithSubmitToolOutputsResource(), meta());

    expect($result)
        ->id->toBe('run_vqUh7mLCAIYjudfN34dMQx4b')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699626348)
        ->threadId->toBe('thread_vAG0173KCY4VKDLQakucIszZ')
        ->assistantId->toBe('asst_elNhDubXFZcsWQd8GuTu93vZ')
        ->status->toBe('requires_action')
        ->startedAt->toBe(1699626349)
        ->expiresAt->toBe(1699626948)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()
        ->tools->tohaveCount(2)
        ->tools->{0}->toBeInstanceOf(ThreadRunResponseToolFunction::class)
        ->tools->{1}->toBeInstanceOf(ThreadRunResponseFileSearch::class)
        ->metadata->toBe([])
        ->meta()->toBeInstanceOf(MetaInformation::class)
        ->responseFormat->toBeInstanceOf(AssistantResponseResponseFormat::class);
});

test('from with submit tool outputs', function () {
    $result = ThreadRunResponse::from(threadRunWithSubmitToolOutputsResource(), meta());

    expect($result)
        ->id->toBe('run_vqUh7mLCAIYjudfN34dMQx4b')
        ->object->toBe('thread.run')
        ->createdAt->toBe(1699626348)
        ->threadId->toBe('thread_vAG0173KCY4VKDLQakucIszZ')
        ->assistantId->toBe('asst_elNhDubXFZcsWQd8GuTu93vZ')
        ->status->toBe('requires_action')
        ->startedAt->toBe(1699626349)
        ->expiresAt->toBe(1699626948)
        ->cancelledAt->toBeNull()
        ->failedAt->toBeNull()
        ->completedAt->toBeNull()
        ->lastError->toBeNull()
        ->model->toBe('gpt-4')
        ->instructions->toBe('You are a personal math tutor. When asked a question, write and run Python code to answer the question.')
        ->tools->toBeArray()
        ->tools->tohaveCount(2)
        ->tools->{0}->toBeInstanceOf(ThreadRunResponseToolFunction::class)
        ->tools->{1}->toBeInstanceOf(ThreadRunResponseFileSearch::class)
        ->metadata->toBe([])
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from with incomplete details', function () {
    $result = ThreadRunResponse::from(threadRunWithIncompleteDetails(), meta());

    expect($result)
        ->incompleteDetails->toBeInstanceOf(ThreadRunResponseIncompleteDetails::class)
        ->incompleteDetails->reason->toBe('Input tokens exceeded');
});

test('from with usage', function () {
    $result = ThreadRunResponse::from(threadRunWithUsageResource(), meta());

    expect($result)
        ->usage->toBeInstanceOf(ThreadRunResponseUsage::class)
        ->usage->promptTokens->toBe(1)
        ->usage->completionTokens->toBe(16)
        ->usage->totalTokens->toBe(17);
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

test('to array with submit tool outputs', function () {
    $result = ThreadRunResponse::from(threadRunWithSubmitToolOutputsResource(), meta());

    expect($result->toArray())
        ->toBe(threadRunWithSubmitToolOutputsResource());
});

test('to array with usage', function () {
    $result = ThreadRunResponse::from(threadRunWithUsageResource(), meta());

    expect($result->toArray())
        ->toBe(threadRunWithUsageResource());
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
