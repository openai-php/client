<?php

use OpenAI\Responses\FineTuning\RetrieveJobResponse;
use OpenAI\Responses\FineTuning\RetrieveJobResponseHyperparameters;
use OpenAI\Responses\Meta\MetaInformation;

test('from create response', function () {
    $result = RetrieveJobResponse::from(fineTuningJobCreateResource(), meta());

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponse::class)
        ->id->toBe('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F')
        ->object->toBe('fine_tuning.job')
        ->model->toBe('gpt-3.5-turbo-0613')
        ->createdAt->toBe(1614807352)
        ->finishedAt->toBeNull()
        ->fineTunedModel->toBeNull()
        ->hyperparameters->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->organizationId->toBe('org-jwe45798ASN82s')
        ->resultFiles->toBeArray()->toBeEmpty()
        ->status->toBe('created')
        ->validationFile->toBeNull()
        ->trainingFile->toBe('file-abc123')
        ->trainedTokens->toBeNull()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('from retrieve response', function () {
    $result = RetrieveJobResponse::from(fineTuningJobRetrieveResource(), meta());

    expect($result)
        ->toBeInstanceOf(RetrieveJobResponse::class)
        ->id->toBe('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F')
        ->object->toBe('fine_tuning.job')
        ->model->toBe('gpt-3.5-turbo-0613')
        ->createdAt->toBe(1614807352)
        ->finishedAt->toBe(1692819450)
        ->fineTunedModel->toBe('ft:gpt-3.5-turbo-0613:jwe-dev::7qnxQ0sQ')
        ->hyperparameters->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->organizationId->toBe('org-jwe45798ASN82s')
        ->resultFiles->toBeArray()->toHaveCount(1)
        ->resultFiles->{0}->toBe('file-1bl05WrhsKDDEdg8XSP617QF')
        ->status->toBe('succeeded')
        ->validationFile->toBeNull()
        ->trainingFile->toBe('file-abc123')
        ->trainedTokens->toBe(5049)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = RetrieveJobResponse::from(fineTuningJobCreateResource(), meta());

    expect($result['id'])->toBe('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F');
});

test('to array', function () {
    $result = RetrieveJobResponse::from(fineTuningJobRetrieveResource(), meta());

    expect($result->toArray())
        ->toBe(fineTuningJobRetrieveResource());
});

test('fake', function () {
    $response = RetrieveJobResponse::fake();

    expect($response)
        ->id->toBe('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F');
});

test('fake with override', function () {
    $response = RetrieveJobResponse::fake([
        'id' => 'ft-1234',
    ]);

    expect($response)
        ->id->toBe('ft-1234');
});
