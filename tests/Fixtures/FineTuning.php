<?php

/**
 * @return array<string, mixed>
 */
function fineTuningJobCreateResource(): array
{
    return [
        'id' => 'ftjob-AF1WoRqd3aJAHsqc9NY7iL8F',
        'object' => 'fine_tuning.job',
        'model' => 'gpt-3.5-turbo-0613',
        'created_at' => 1614807352,
        'finished_at' => null,
        'fine_tuned_model' => null,
        'hyperparameters' => [
            'n_epochs' => 9,
            'batch_size' => 'auto',
            'learning_rate_multiplier' => 'auto',
        ],
        'organization_id' => 'org-jwe45798ASN82s',
        'result_files' => [],
        'status' => 'created',
        'validation_file' => null,
        'training_file' => 'file-abc123',
        'trained_tokens' => null,
        'error' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuningJobRetrieveResource(): array
{
    return [
        'id' => 'ftjob-AF1WoRqd3aJAHsqc9NY7iL8F',
        'object' => 'fine_tuning.job',
        'model' => 'gpt-3.5-turbo-0613',
        'created_at' => 1614807352,
        'finished_at' => 1692819450,
        'fine_tuned_model' => 'ft:gpt-3.5-turbo-0613:jwe-dev::7qnxQ0sQ',
        'hyperparameters' => [
            'n_epochs' => 9,
            'batch_size' => 1,
            'learning_rate_multiplier' => 2.2,
        ],
        'organization_id' => 'org-jwe45798ASN82s',
        'result_files' => [
            'file-1bl05WrhsKDDEdg8XSP617QF',
        ],
        'status' => 'succeeded',
        'validation_file' => null,
        'training_file' => 'file-abc123',
        'trained_tokens' => 5049,
        'error' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuningFailedJobRetrieveResource(): array
{
    return [
        'id' => 'ftjob-AF1WoRqd3aJAHsqc9NY7iL8F',
        'object' => 'fine_tuning.job',
        'model' => 'gpt-3.5-turbo-0613',
        'created_at' => 1614807352,
        'finished_at' => null,
        'fine_tuned_model' => null,
        'hyperparameters' => [
            'n_epochs' => 9,
            'batch_size' => 'auto',
            'learning_rate_multiplier' => 'auto',
        ],
        'organization_id' => 'org-jwe45798ASN82s',
        'result_files' => [],
        'status' => 'failed',
        'validation_file' => null,
        'training_file' => 'file-abc123',
        'trained_tokens' => null,
        'error' => [
            'code' => 'invalid_n_examples',
            'param' => 'training_file',
            'message' => 'Training file has 3 example(s), but must have at least 10 examples',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuningJobListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            fineTuningJobRetrieveResource(),
            fineTuningJobRetrieveResource(),
        ],
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuningJobMessageEventResource(): array
{
    return [
        'object' => 'fine_tuning.job.event',
        'id' => 'ft-event-ddTJfwuMVpfLXseO0Am0Gqjm',
        'created_at' => 1692407401,
        'level' => 'info',
        'message' => 'Fine tuning job successfully completed',
        'data' => null,
        'type' => 'message',
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuningJobMetricsEventResource(): array
{
    return [
        'object' => 'fine_tuning.job.event',
        'id' => 'ftevent-kLPSMIcsqshEUEJVOVBVcHlP',
        'created_at' => 1692887003,
        'level' => 'info',
        'message' => 'Step 99/99: training loss=0.11',
        'data' => [
            'step' => 99,
            'train_loss' => 0.11462418735027,
            'train_mean_token_accuracy' => 0.94999998807907,
        ],
        'type' => 'metrics',
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTuningJobListEventsResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            fineTuningJobMessageEventResource(),
            fineTuningJobMetricsEventResource(),
        ],
        'has_more' => true,
    ];
}
