<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseMessageCreation;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseMessageCreationStepDetails;

test('from', function () {
    $result = ThreadRunStepResponseMessageCreationStepDetails::from(threadRunStepResource()['step_details']);
    expect($result)
        ->type->toBe('message_creation')
        ->messageCreation->toBeInstanceOf(ThreadRunStepResponseMessageCreation::class);
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseMessageCreationStepDetails::from(threadRunStepResource()['step_details']);

    expect($result['type'])
        ->toBe('message_creation');
});

test('to array', function () {
    $result = ThreadRunStepResponseMessageCreationStepDetails::from(threadRunStepResource()['step_details']);

    expect($result->toArray())
        ->toBe(threadRunStepResource()['step_details']);
});
