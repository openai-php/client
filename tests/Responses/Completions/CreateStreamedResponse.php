<?php

use OpenAI\Responses\Completions\CreateStreamedResponse;

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response->getIterator()->current())
        ->id->toBe('cmpl-6ynJi2uZZnKntnEZreDcjGyoPbVAn');
});

test('fake with override', function () {
    $response = CreateStreamedResponse::fake(completionStream());

    expect($response->getIterator()->current())
        ->id->toBe('cmpl-6wcyFqMKXiZffiydSfWHhjcgsf3KD');
});
