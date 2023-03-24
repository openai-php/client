<?php

/**
 * @return array<string, mixed>
 */
function fineTuneResource(): array
{
    return [
        'id' => 'ft-AF1WoRqd3aJAHsqc9NY7iL8F',
        'object' => 'fine-tune',
        'model' => 'curie',
        'created_at' => 1614807352,
        'events' => [
            fineTuneEventResource(),
            fineTuneEventResource(),
        ],
        'fine_tuned_model' => 'curie => ft-acmeco-2021-03-03-21-44-20',
        'hyperparams' => [
            'batch_size' => 4,
            'learning_rate_multiplier' => 0.1,
            'n_epochs' => 4,
            'prompt_loss_weight' => 0.1,
        ],
        'organization_id' => 'org-jwe45798ASN82s',
        'result_files' => [
            fileResource(),
            fileResource(),
        ],
        'status' => 'succeeded',
        'validation_files' => [
            fileResource(),
            fileResource(),
        ],
        'training_files' => [
            fileResource(),
            fileWithErrorStatusResource(),
        ],
        'updated_at' => 1614807865,
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuneListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            fineTuneResource(),
            fineTuneResource(),
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuneEventResource(): array
{
    return [
        'object' => 'fine-tune-event',
        'created_at' => 1614807352,
        'level' => 'info',
        'message' => 'Job enqueued. Waiting for jobs ahead to complete. Queue number =>  0.',
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuneListEventsResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            fineTuneEventResource(),
            fineTuneEventResource(),
        ],
    ];
}

/**
 * @return resource
 */
function fineTuneListEventsStream()
{
    return fopen(__DIR__.'/Streams/FineTuneEvents.txt', 'r');
}
