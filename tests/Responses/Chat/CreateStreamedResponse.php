<?php

use OpenAI\Responses\Chat\CreateStreamedResponse;

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response->getIterator()->current())
        ->id->toBe('chatcmpl-6yo21W6LVo8Tw2yBf7aGf2g17IeIl');
});

test('fake with override', function () {
    $response = CreateStreamedResponse::fake(chatCompletionStream());

    expect($response->getIterator()->current())
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz');
});
