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
        'shutdown_date' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function deprecatedModel(): array
{
    return [
        'id' => 'gpt-4o-2024-08-06',
        'object' => 'model',
        'created' => 1722814719,
        'owned_by' => 'system',
        'shutdown_date' => '2027-01-14',
    ];
}

/**
 * @return array<string, string>
 */
function googleModel(): array
{
    return [
        'id' => 'text-davinci-003',
        'object' => 'model',
        'owned_by' => 'google',
    ];
}

/**
 * @return array<string, mixed>
 */
function azureModel(): array
{
    return [
        'id' => 'gpt-35-turbo',
        'object' => 'model',
        'created_at' => 1700000000,
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
            deprecatedModel(),
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
