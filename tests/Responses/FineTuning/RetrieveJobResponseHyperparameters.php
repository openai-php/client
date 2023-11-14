<?php

use OpenAI\Responses\FineTuning\RetrieveJobResponseHyperparameters;

test('from', function () {
    $result = RetrieveJobResponseHyperparameters::from(fineTuningJobRetrieveResource()['hyperparameters']);

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->nEpochs->toBe(9)
        ->batchSize->toBe(1)
        ->learningRateMultiplier->toBe(2.0);
});

test('failed job from', function () {
    $result = RetrieveJobResponseHyperparameters::from(fineTuningFailedJobRetrieveResource()['hyperparameters']);

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->nEpochs->toBe(9)
        ->batchSize->toBe('auto')
        ->learningRateMultiplier->toBe('auto');
});

test('to array', function () {
    $result = RetrieveJobResponseHyperparameters::from(fineTuningJobRetrieveResource()['hyperparameters']);

    expect($result->toArray())
        ->toBe(fineTuningJobRetrieveResource()['hyperparameters']);
});

test('failed to array', function () {
    $result = RetrieveJobResponseHyperparameters::from(fineTuningFailedJobRetrieveResource()['hyperparameters']);

    expect($result->toArray())
        ->toBe(fineTuningFailedJobRetrieveResource()['hyperparameters']);
});

test('hyperparameters params can be a string', function () {
    $result = RetrieveJobResponseHyperparameters::from([
        'n_epochs' => 'auto',
        'batch_size' => 'auto',
        'learning_rate_multiplier' => 'auto',
    ]);

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->nEpochs->toBe('auto')
        ->batchSize->toBe('auto')
        ->learningRateMultiplier->toBe('auto');
});
