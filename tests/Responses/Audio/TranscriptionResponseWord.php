<?php

use OpenAI\Responses\Audio\TranscriptionResponseWord;

test('from', function () {
    $result = TranscriptionResponseWord::from(audioTranscriptionVerboseJson()['words'][0]);

    expect($result)
        ->toBeInstanceOf(TranscriptionResponseWord::class)
        ->word->toBe('Hello')
        ->start->toBe(0.31999999284744)
        ->end->toBe(0.9200000166893);
});

test('to array', function () {
    $result = TranscriptionResponseWord::from(audioTranscriptionVerboseJson()['words'][0]);

    expect($result->toArray())
        ->toBe(audioTranscriptionVerboseJson()['words'][0]);
});
