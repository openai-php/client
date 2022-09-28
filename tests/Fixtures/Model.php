<?php

/**
 * @return array<string, mixed>
 */
function model(): array
{
    return [
        'id' => 'text-babbage:001',
        'object' => 'model',
        'created' => 1642018370,
        'owned_by' => 'openai',
        'permission' => [
            'id' => 'snapperm-7oP3WFr9x7qf5xb3eZrVABAH',
            'object' => 'model_permission',
            'created' => 1642018480,
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
        'root' => 'text-babbage:001',
        'parent' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function fineTunedModelDeleteResource(): array
{
    return [
        'id' => 'curie:ft-acmeco-2021-03-03-21-44-20',
        'object' => 'model',
        'deleted' => true,
    ];
}
