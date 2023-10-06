<?php

use OpenAI\Responses\FineTuning\RetrieveJobResponseHyperparameters;

test('from', function () {
    $result = RetrieveJobResponseHyperparameters::from(fineTuningJobRetrieveResource()['hyperparameters']);

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->nEpochs->toBe(9);
});

test('to array', function () {
    $result = RetrieveJobResponseHyperparameters::from(fineTuningJobRetrieveResource()['hyperparameters']);

    expect($result->toArray())
        ->toBe(fineTuningJobRetrieveResource()['hyperparameters']);
});

test('nEpochs can be a string', function () {
    $result = RetrieveJobResponseHyperparameters::from([
        'n_epochs' => 'auto',
    ]);

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->nEpochs->toBe('auto');
});
