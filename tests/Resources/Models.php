<?php

use OpenAI\Responses\Models\DeleteResponse;
use OpenAI\Responses\Models\ListResponse;
use OpenAI\Responses\Models\RetrieveResponse;
use OpenAI\Responses\Models\RetrieveResponsePermission;

test('list', function () {
    $client = mockClient('GET', 'models', [], modelList());

    $result = $client->models()->list();

    expect($result)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class);

    expect($result->data[0])
        ->id->toBe('text-babbage:001');
});

test('retrieve', function () {
    $client = mockClient('GET', 'models/da-vince', [], model());

    $result = $client->models()->retrieve('da-vince');

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('text-babbage:001')
        ->object->toBe('model')
        ->created->toBe(1642018370)
        ->ownedBy->toBe('openai')
        ->permission->toBeArray()->toHaveCount(1)
        ->permission->each->toBeInstanceOf(RetrieveResponsePermission::class)
        ->root->toBe('text-babbage:001')
        ->parent->toBe(null);

    expect($result->permission[0])
        ->id->toBe('snapperm-7oP3WFr9x7qf5xb3eZrVABAH')
        ->object->toBe('model_permission')
        ->created->toBe(1642018480)
        ->allowCreateEngine->toBe(false)
        ->allowSampling->toBe(true)
        ->allowLogprobs->toBe(true)
        ->allowSearchIndices->toBe(false)
        ->allowView->toBe(true)
        ->allowFineTuning->toBe(false)
        ->organization->toBe('*')
        ->group->toBe(null)
        ->isBlocking->toBe(false);
});

test('delete fine tuned model', function () {
    $client = mockClient('DELETE', 'models/curie:ft-acmeco-2021-03-03-21-44-20', [], fineTunedModelDeleteResource());

    $result = $client->models()->delete('curie:ft-acmeco-2021-03-03-21-44-20');

    expect($result)
        ->toBeInstanceOf(DeleteResponse::class)
        ->id->toBe('curie:ft-acmeco-2021-03-03-21-44-20')
        ->object->toBe('model')
        ->deleted->toBe(true);
});
