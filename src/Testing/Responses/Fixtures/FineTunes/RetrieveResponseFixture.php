<?php

namespace OpenAI\Testing\Responses\Fixtures\FineTunes;

use OpenAI\Testing\Responses\Fixtures\Files\CreateResponseFixture;

final class RetrieveResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'ft-AF1WoRqd3aJAHsqc9NY7iL8F',
        'object' => 'fine-tune',
        'model' => 'curie',
        'created_at' => 1_614_807_352,
        'events' => [
            [
                'object' => 'fine-tune-event',
                'created_at' => 1_614_807_352,
                'level' => 'info',
                'message' => 'Job enqueued. Waiting for jobs ahead to complete. Queue number =>  0.',
            ],
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
            CreateResponseFixture::ATTRIBUTES,
        ],
        'status' => 'succeeded',
        'validation_files' => [
            CreateResponseFixture::ATTRIBUTES,
        ],
        'training_files' => [
            CreateResponseFixture::ATTRIBUTES,
        ],
        'updated_at' => 1_614_807_865,
    ];
}
