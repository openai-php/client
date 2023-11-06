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
    ];
}

/**
 * @return array<string, mixed>
 */
function modelList(): array
{
    return [
        'object' => 'list',
        'data' => [
            model(),
            model(),
        ],
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
