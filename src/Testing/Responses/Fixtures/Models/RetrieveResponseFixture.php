<?php

namespace OpenAI\Testing\Responses\Fixtures\Models;

final class RetrieveResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'text-babbage:001',
        'object' => 'model',
        'created' => 1_642_018_370,
        'owned_by' => 'openai',
        'permission' => [
            [
                'id' => 'snapperm-7oP3WFr9x7qf5xb3eZrVABAH',
                'object' => 'model_permission',
                'created' => 1_642_018_480,
                'allow_create_engine' => false,
                'allow_sampling' => true,
                'allow_logprobs' => true,
                'allow_search_indices' => false,
                'allow_view' => true,
                'allow_fine_tuning' => false,
                'organization' => '*',
                'group' => null,
                'is_blocking' => false,
            ],
        ],
        'root' => 'text-babbage:001',
        'parent' => null,
    ];
}
