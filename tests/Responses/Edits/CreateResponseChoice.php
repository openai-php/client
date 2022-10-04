<?php

use OpenAI\Responses\Edits\CreateResponseChoice;

test('from', function () {
    $result = CreateResponseChoice::from(edit()['choices'][0]);

    expect($result)
        ->text->toBe("What day of the week is it?\n")
        ->index->toBe(0);
});

test('to array', function () {
    $result = CreateResponseChoice::from(edit()['choices'][0]);

    expect($result->toArray())
        ->toBe(edit()['choices'][0]);
});
