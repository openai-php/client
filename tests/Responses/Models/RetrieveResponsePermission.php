<?php

use OpenAI\Responses\Models\RetrieveResponsePermission;

test('from', function () {
    $result = RetrieveResponsePermission::from(model()['permission'][0]);

    expect($result)
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

test('to array', function () {
    $result = RetrieveResponsePermission::from(model()['permission'][0]);

    expect($result->toArray())
        ->toBe(model()['permission'][0]);
});
