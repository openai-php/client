<?php

use OpenAI\Exceptions\UnknownEventException;
use OpenAI\Responses\Threads\Messages\Delta\ThreadMessageDeltaResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\Runs\Steps\Delta\ThreadRunStepDeltaResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunStreamResponse;
use OpenAI\Responses\Threads\ThreadResponse;

test('fake', function () {
    $response = ThreadRunStreamResponse::fake();

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(ThreadResponse::class)
        ->id->toBe('thread_sSbvUX4J1FqlUZBv6BaBbOj4');
});

test('handles message delta', function () {
    $response = ThreadRunStreamResponse::fake(messageDeltaThreadRunStream());

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(ThreadMessageDeltaResponse::class)
        ->id->toBe('msg_zKgPBqNcqb7qYP2bBA3tVyTd');
});

test('handles thread created', function () {
    $response = ThreadRunStreamResponse::fake(runCreatedThreadRunStream());

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(ThreadRunResponse::class)
        ->id->toBe('run_s1X8yAjuUBlwhGrqiahzfnH7');
});

test('handles thread run step', function () {
    $response = ThreadRunStreamResponse::fake(runCreatedThreadStepCreatedStream());

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(ThreadRunStepResponse::class)
        ->id->toBe('step_3P1u5J5Rs95lypEfvQ3rMdPL');
});

test('handles message created', function () {
    $response = ThreadRunStreamResponse::fake(runCreatedThreadMessageCreatedStream());

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(ThreadMessageResponse::class)
        ->id->toBe('msg_zKgPBqNcqb7qYP2bBA3tVyTd');
});

test('handles thread run delta', function () {
    $response = ThreadRunStreamResponse::fake(runCreatedThreadRunStepDeltaStream());

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(ThreadRunStepDeltaResponse::class)
        ->id->toBe('step_rQmJPtF2uOyGhSCCHqk1zoVd');
});

test('handles invalid event', function () {
    $response = ThreadRunStreamResponse::fake(runCreatedThreadInvalidEventStream());

    expect(fn () => $response->getIterator()->current()->response)
        ->toThrow(UnknownEventException::class);
});
