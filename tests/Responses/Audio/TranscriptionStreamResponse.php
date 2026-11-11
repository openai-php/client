<?php

use OpenAI\Responses\Audio\TranscriptionStreamResponse;

test('fake', function () {
    $response = TranscriptionStreamResponse::fake();

    expect($response->getIterator()->current())
        ->toBeInstanceOf(TranscriptionStreamResponse::class)
        ->event->toBe('transcript.text.delta');
});
