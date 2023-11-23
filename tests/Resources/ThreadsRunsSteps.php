<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepListResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseMessageCreationStepDetails;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs/run_vqUh7mLCAIYjudfN34dMQx4b/steps', [], Response::from(threadRunStepListResource(), metaHeaders()));

    $result = $client->threads()->runs()->steps()->list('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'run_vqUh7mLCAIYjudfN34dMQx4b');

    expect($result)
        ->toBeInstanceOf(ThreadRunStepListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ThreadRunStepResponse::class)
        ->firstId->toBe('step_1spQXgbAabXFm1YXrwiGIMUz')
        ->lastId->toBe('step_1spQXgbAabXFm1YXrwiGIMUz')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'threads/thread_agvtHUGezjTCt4SKgQg0NJ2Y/runs/run_vqUh7mLCAIYjudfN34dMQx4b/steps/step_1spQXgbAabXFm1YXrwiGIMUz', [], Response::from(threadRunStepResource(), metaHeaders()));

    $result = $client->threads()->runs()->steps()->retrieve('thread_agvtHUGezjTCt4SKgQg0NJ2Y', 'run_vqUh7mLCAIYjudfN34dMQx4b', 'step_1spQXgbAabXFm1YXrwiGIMUz');

    expect($result)
        ->toBeInstanceOf(ThreadRunStepResponse::class)
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
        ->lastError->toBeNull()
        ->stepDetails->toBeInstanceOf(ThreadRunStepResponseMessageCreationStepDetails::class);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
