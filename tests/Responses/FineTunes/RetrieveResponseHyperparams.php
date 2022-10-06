<?php

use OpenAI\Responses\FineTunes\RetrieveResponseHyperparams;

test('from', function () {
    $result = RetrieveResponseHyperparams::from(fineTuneResource()['hyperparams']);

    expect($result)
        ->toBeInstanceOf(RetrieveResponseHyperparams::class)
        ->batchSize->toBe(4)
        ->learningRateMultiplier->toBe(0.1)
        ->nEpochs->toBe(4)
        ->promptLossWeight->toBe(0.1);
});

test('to array', function () {
    $result = RetrieveResponseHyperparams::from(fineTuneResource()['hyperparams']);

    expect($result->toArray())
        ->toBe(fineTuneResource()['hyperparams']);
});
