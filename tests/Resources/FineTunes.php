<?php

test('create', function () {
    $client = mockClient('POST', 'fine-tunes', [
        'training_file' => 'file-XjGxS3KTG0uNmNOK362iJua3',
        'validation_file' => 'file-XjGxS3KTG0uNmNOK362iJua3',
        'model' => 'curie',
        'n_epochs' => 4,
        'batch_size' => null,
        'learning_rate_multiplier' => null,
        'prompt_loss_weight' => 0.01,
        'compute_classification_metrics' => false,
        'classification_n_classes' => null,
        'classification_positive_class' => null,
        'classification_betas' => [],
        'suffix' => null,
    ], [
        fineTuneResource(),
    ]);

    $result = $client->fineTunes()->create([
        'training_file' => 'file-XjGxS3KTG0uNmNOK362iJua3',
        'validation_file' => 'file-XjGxS3KTG0uNmNOK362iJua3',
        'model' => 'curie',
        'n_epochs' => 4,
        'batch_size' => null,
        'learning_rate_multiplier' => null,
        'prompt_loss_weight' => 0.01,
        'compute_classification_metrics' => false,
        'classification_n_classes' => null,
        'classification_positive_class' => null,
        'classification_betas' => [],
        'suffix' => null,
    ]);

    expect($result)->toBeArray()->toBe([
        fineTuneResource(),
    ]);
});

test('list', function () {
    $client = mockClient('GET', 'fine-tunes', [], [
        'object' => 'list',
        'data' => [
            fineTuneResource(),
            fineTuneResource(),
        ],
    ]);

    $result = $client->fineTunes()->list();

    expect($result)->toBeArray()->toBe([
        'object' => 'list',
        'data' => [
            fineTuneResource(),
            fineTuneResource(),
        ],
    ]);
});

test('retrieve', function () {
    $client = mockClient('GET', 'fine-tunes/ft-AF1WoRqd3aJAHsqc9NY7iL8F', [], fineTuneResource());

    $result = $client->fineTunes()->retrieve('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

    expect($result)->toBeArray()->toBe(fineTuneResource());
});

test('cancel', function () {
    $client = mockClient('POST', 'fine-tunes/ft-AF1WoRqd3aJAHsqc9NY7iL8F/cancel', [], fineTuneResource());

    $result = $client->fineTunes()->cancel('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

    expect($result)->toBeArray()->toBe(fineTuneResource());
});

test('list events', function () {
    $client = mockClient('GET', 'fine-tunes/ft-AF1WoRqd3aJAHsqc9NY7iL8F/events', [], [
        'object' => 'list',
        'data' => [
            fineTuneEventResource(),
            fineTuneEventResource(),
        ],
    ]);

    $result = $client->fineTunes()->listEvents('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

    expect($result)->toBeArray()->toBe([
        'object' => 'list',
        'data' => [
            fineTuneEventResource(),
            fineTuneEventResource(),
        ],
    ]);
});
