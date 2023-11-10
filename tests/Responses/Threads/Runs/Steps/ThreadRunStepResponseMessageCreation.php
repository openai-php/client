<?php

use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseMessageCreation;

test('from', function () {
    $result = ThreadRunStepResponseMessageCreation::from(threadRunStepResource()['step_details']['message_creation']);
    expect($result)
        ->messageId->toBe('msg_i404PxKbB92d0JAmdOIcX7vA');
});

test('as array accessible', function () {
    $result = ThreadRunStepResponseMessageCreation::from(threadRunStepResource()['step_details']['message_creation']);

    expect($result['message_id'])
        ->toBe('msg_i404PxKbB92d0JAmdOIcX7vA');
});

test('to array', function () {
    $result = ThreadRunStepResponseMessageCreation::from(threadRunStepResource()['step_details']['message_creation']);

    expect($result->toArray())
        ->toBe(threadRunStepResource()['step_details']['message_creation']);
});
