<?php

use OpenAI\Responses\FineTuning\ListJobsResponse;
use OpenAI\Responses\FineTuning\RetrieveJobResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $response = ListJobsResponse::from(fineTuningJobListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ListJobsResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveJobResponse::class)
        ->hasMore->toBeFalse()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ListJobsResponse::from(fineTuningJobListResource(), meta());

    expect($response['object'])->toBe('list');
});

test('to array', function () {
    $response = ListJobsResponse::from(fineTuningJobListResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(fineTuningJobListResource());
});

test('fake', function () {
    $response = ListJobsResponse::fake();

    expect($response)
        ->object->toBe('list')
        ->and($response['data'][0])
        ->id->toBe('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F');
});

test('fake with override', function () {
    $response = ListJobsResponse::fake([
        'data' => [
            [
                'id' => 'ft-1234',
            ],
        ],
    ]);

    expect($response)
        ->object->toBe('list')
        ->and($response['data'][0])
        ->id->toBe('ft-1234');
});
