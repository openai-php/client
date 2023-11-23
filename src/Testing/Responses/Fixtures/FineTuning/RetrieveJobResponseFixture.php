<?php

namespace OpenAI\Testing\Responses\Fixtures\FineTuning;

final class RetrieveJobResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'ftjob-AF1WoRqd3aJAHsqc9NY7iL8F',
        'object' => 'fine_tuning.job',
        'model' => 'gpt-3.5-turbo-0613',
        'created_at' => 1_614_807_352,
        'finished_at' => 1_692_819_450,
        'fine_tuned_model' => 'ft:gpt-3.5-turbo-0613:gehri-dev::7qnxQ0sQ',
        'hyperparameters' => [
            'n_epochs' => 9,
            'batch_size' => 1,
            'learning_rate_multiplier' => 2,
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
