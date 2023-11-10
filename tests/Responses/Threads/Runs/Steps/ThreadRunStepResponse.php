<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseMessageCreationStepDetails;

test('from', function () {
    $result = ThreadRunStepResponse::from(threadRunStepResource(), meta());

    expect($result)
        ->id->toBe('step_1spQXgbAabXFm1YXrwiGIMUz')
        ->object->toBe('thread.run.step')
        ->createdAt->toBe(1699564106)
        ->runId->toBe('run_fYijubpOJsKDnvtACWBS8C8r')
        ->assistantId->toBe('asst_EopvUEMh90bxkNRYEYM81Orc')
        ->threadId->toBe('thread_3WdOgtVuhD8aUIEx774Whkvo')
        ->type->toBe('message_creation')
        ->status->toBe('completed')
        ->cancelledAt->toBeNull()
        ->completedAt->toBe(1699564119)
        ->expiresAt->toBeNull()
        ->failedAt->toBeNull()
        ->last_error->toBeNull()
        ->stepDetails->toBeInstanceOf(ThreadRunStepResponseMessageCreationStepDetails::class)
        ->metadata->toBe([])
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponse::from(threadRunStepResource(), meta());

    expect($result['id'])
        ->toBe('step_1spQXgbAabXFm1YXrwiGIMUz');
});

test('to array', function () {
    $result = ThreadRunStepResponse::from(threadRunStepResource(), meta());

    expect($result->toArray())
        ->toBe(threadRunStepResource());
});

test('fake', function () {
    $response = ThreadRunStepResponse::fake();

    expect($response)
        ->id->toBe('step_1spQXgbAabXFm1YXrwiGIMUz');
});

test('fake with override', function () {
    $response = ThreadRunStepResponse::fake([
        'id' => 'step_1234',
    ]);

    expect($response)
        ->id->toBe('step_1234');
});
