<?php

use OpenAI\Responses\FineTuning\ListJobEventsResponse;
use OpenAI\Responses\FineTuning\ListJobEventsResponseEvent;
use OpenAI\Responses\FineTuning\ListJobEventsResponseEventData;
use OpenAI\Responses\FineTuning\ListJobsResponse;
use OpenAI\Responses\FineTuning\RetrieveJobResponse;
use OpenAI\Responses\FineTuning\RetrieveJobResponseHyperparameters;
use OpenAI\Responses\Meta\MetaInformation;

test('create job', function () {
    $client = mockClient('POST', 'fine_tuning/jobs', [
        'training_file' => 'file-abc123',
        'validation_file' => null,
        'model' => 'gpt-3.5-turbo-0613',
        'hyperparameters' => [
            'n_epochs' => 4,
        ],
        'suffix' => null,
    ], \OpenAI\ValueObjects\Transporter\Response::from(fineTuningJobCreateResource(), metaHeaders()));

    $result = $client->fineTuning()->createJob([
        'training_file' => 'file-abc123',
        'validation_file' => null,
        'model' => 'gpt-3.5-turbo-0613',
        'hyperparameters' => [
            'n_epochs' => 4,
        ],
        'suffix' => null,
    ]);

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
        ->error->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list jobs', function () {
    $client = mockClient('GET', 'fine_tuning/jobs', [], \OpenAI\ValueObjects\Transporter\Response::from(fineTuningJobListResource(), metaHeaders()));

    $result = $client->fineTuning()->listJobs();

    expect($result)
        ->toBeInstanceOf(ListJobsResponse::class)
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveJobResponse::class);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list jobs with params', function () {
    $client = mockClient('GET', 'fine_tuning/jobs', ['limit' => 3], \OpenAI\ValueObjects\Transporter\Response::from(fineTuningJobListResource(), metaHeaders()));

    $result = $client->fineTuning()->listJobs(['limit' => 3]);

    expect($result)
        ->toBeInstanceOf(ListJobsResponse::class)
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveJobResponse::class);
});

test('retrieve job', function () {
    $client = mockClient('GET', 'fine_tuning/jobs/ftjob-AF1WoRqd3aJAHsqc9NY7iL8F', [], \OpenAI\ValueObjects\Transporter\Response::from(fineTuningJobRetrieveResource(), metaHeaders()));

    $result = $client->fineTuning()->retrieveJob('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F');

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
        ->trainedTokens->toBe(5049);

    expect($result->hyperparameters)
        ->toBeInstanceOf(RetrieveJobResponseHyperparameters::class)
        ->nEpochs->toBe(9);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('cancel job', function () {
    $client = mockClient('POST', 'fine_tuning/jobs/ftjob-AF1WoRqd3aJAHsqc9NY7iL8F/cancel', [], \OpenAI\ValueObjects\Transporter\Response::from([...fineTuningJobRetrieveResource(), 'status' => 'cancelled'], metaHeaders()));

    $result = $client->fineTuning()->cancelJob('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F');

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
        ->status->toBe('cancelled')
        ->validationFile->toBeNull()
        ->trainingFile->toBe('file-abc123')
        ->trainedTokens->toBe(5049);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list job events', function () {
    $client = mockClient('GET', 'fine_tuning/jobs/ftjob-AF1WoRqd3aJAHsqc9NY7iL8F/events', [], \OpenAI\ValueObjects\Transporter\Response::from(fineTuningJobListEventsResource(), metaHeaders()));

    $result = $client->fineTuning()->listJobEvents('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F');

    expect($result)
        ->toBeInstanceOf(ListJobEventsResponse::class)
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ListJobEventsResponseEvent::class);

    expect($result->data[0])
        ->toBeInstanceOf(ListJobEventsResponseEvent::class)
        ->object->toBe('fine_tuning.job.event')
        ->id->toBe('ft-event-ddTJfwuMVpfLXseO0Am0Gqjm')
        ->createdAt->toBe(1692407401)
        ->level->toBe(\OpenAI\Enums\FineTuning\FineTuningEventLevel::Info)
        ->message->toBe('Fine tuning job successfully completed')
        ->data->toBeNull()
        ->type->toBe('message');

    expect($result->data[1])
        ->toBeInstanceOf(ListJobEventsResponseEvent::class)
        ->object->toBe('fine_tuning.job.event')
        ->id->toBe('ftevent-kLPSMIcsqshEUEJVOVBVcHlP')
        ->createdAt->toBe(1692887003)
        ->level->toBe(\OpenAI\Enums\FineTuning\FineTuningEventLevel::Info)
        ->message->toBe('Step 99/99: training loss=0.11')
        ->data->toBeInstanceOf(ListJobEventsResponseEventData::class)
        ->type->toBe('metrics');

    expect($result->data[1]->data)
        ->toBeInstanceOf(ListJobEventsResponseEventData::class)
        ->step->toBe(99)
        ->trainLoss->toBe(0.11462418735027)
        ->trainMeanTokenAccuracy->toBe(0.94999998807907);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list job events with params', function () {
    $client = mockClient('GET', 'fine_tuning/jobs/ftjob-AF1WoRqd3aJAHsqc9NY7iL8F/events', ['limit' => 3], \OpenAI\ValueObjects\Transporter\Response::from(fineTuningJobListEventsResource(), metaHeaders()));

    $result = $client->fineTuning()->listJobEvents('ftjob-AF1WoRqd3aJAHsqc9NY7iL8F', ['limit' => 3]);

    expect($result)
        ->toBeInstanceOf(ListJobEventsResponse::class)
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ListJobEventsResponseEvent::class);
});
