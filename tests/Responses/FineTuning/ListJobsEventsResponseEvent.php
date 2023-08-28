<?php

use OpenAI\Enums\FineTuning\FineTuningEventLevel;
use OpenAI\Responses\FineTuning\ListJobEventsResponseEvent;
use OpenAI\Responses\FineTuning\ListJobEventsResponseEventData;

test('from message event', function () {
    $result = ListJobEventsResponseEvent::from(fineTuningJobMessageEventResource());

    expect($result)
        ->toBeInstanceOf(ListJobEventsResponseEvent::class)
        ->object->toBe('fine_tuning.job.event')
        ->id->toBe('ft-event-ddTJfwuMVpfLXseO0Am0Gqjm')
        ->createdAt->toBe(1692407401)
        ->level->toBe(FineTuningEventLevel::Info)
        ->message->toBe('Fine tuning job successfully completed')
        ->data->toBeNull()
        ->type->toBe('message');
});

test('from metrics event', function () {
    $result = ListJobEventsResponseEvent::from(fineTuningJobMetricsEventResource());

    expect($result)
        ->toBeInstanceOf(ListJobEventsResponseEvent::class)
        ->object->toBe('fine_tuning.job.event')
        ->id->toBe('ftevent-kLPSMIcsqshEUEJVOVBVcHlP')
        ->createdAt->toBe(1692887003)
        ->level->toBe(FineTuningEventLevel::Info)
        ->message->toBe('Step 99/99: training loss=0.11')
        ->data->toBeInstanceOf(ListJobEventsResponseEventData::class)
        ->type->toBe('metrics');
});

test('to array', function () {
    $result = ListJobEventsResponseEvent::from(fineTuningJobMessageEventResource());

    expect($result->toArray())
        ->toBe(fineTuningJobMessageEventResource());
});
