<?php

use OpenAI\Responses\FineTuning\RetrieveJobResponseError;

test('from', function () {
    $result = \OpenAI\Responses\FineTuning\RetrieveJobResponseError::from(fineTuningJobRetrieveResource()['error']);

    expect($result)->toBeNull();
});

test('failed job from', function () {
    $result = RetrieveJobResponseError::from(fineTuningFailedJobRetrieveResource()['error']);

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponseError::class)
        ->code->toBe('invalid_n_examples')
        ->param->toBe('training_file')
        ->message->toBe('Training file has 3 example(s), but must have at least 10 examples');
});

test('to array', function () {
    $result = RetrieveJobResponseError::from(fineTuningJobRetrieveResource()['error']);

    expect($result?->toArray())
        ->toBeNull();
});

test('failed job to array', function () {
    $result = RetrieveJobResponseError::from(fineTuningFailedJobRetrieveResource()['error']);

    expect($result->toArray())
        ->toBe(fineTuningFailedJobRetrieveResource()['error']);
});
