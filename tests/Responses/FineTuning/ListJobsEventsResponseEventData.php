<?php

use OpenAI\Responses\FineTuning\ListJobEventsResponseEventData;

test('from', function () {
    $result = ListJobEventsResponseEventData::from(fineTuningJobMetricsEventResource()['data']);

    expect($result)
        ->toBeInstanceOf(ListJobEventsResponseEventData::class)
        ->step->toBe(99)
        ->trainLoss->toBe(0.11462418735027)
        ->trainMeanTokenAccuracy->toBe(0.94999998807907);
});

test('to array', function () {
    $result = ListJobEventsResponseEventData::from(fineTuningJobMetricsEventResource()['data']);

    expect($result->toArray())
        ->toBe(fineTuningJobMetricsEventResource()['data']);
});
