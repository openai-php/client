<?php

use OpenAI\Responses\FineTunes\RetrieveResponseEvent;

test('from', function () {
    $result = RetrieveResponseEvent::from(fineTuneEventResource());

    expect($result)
        ->toBeInstanceOf(RetrieveResponseEvent::class)
        ->object->toBe('fine-tune-event')
        ->createdAt->toBe(1614807352)
        ->level->toBe('info')
        ->message->toBe('Job enqueued. Waiting for jobs ahead to complete. Queue number =>  0.');
});

test('to array', function () {
    $result = RetrieveResponseEvent::from(fineTuneEventResource());

    expect($result->toArray())
        ->toBe(fineTuneEventResource());
});
