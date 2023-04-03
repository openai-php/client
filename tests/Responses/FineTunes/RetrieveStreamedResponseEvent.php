<?php

use OpenAI\Responses\FineTunes\RetrieveStreamedResponseEvent;

test('fake', function () {
    $response = RetrieveStreamedResponseEvent::fake();

    expect($response->getIterator()->current())
        ->message->toBe('Created fine-tune: ft-y3OpNlc8B5qBVGCCVsLZsDST');
});

test('fake with override', function () {
    $response = RetrieveStreamedResponseEvent::fake(fineTuneListEventsStream());

    expect($response->getIterator()->current())
        ->message->toBe('Created fine-tune: ft-MaoEAULREoazpupm8uB7qoIl');
});
