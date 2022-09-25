<?php

test('create', function () {
    $client = mockClient('POST', 'edits', [
        'model' => 'text-davinci-edit-001',
        'input' => 'What day of the wek is it?',
        'instruction' => 'Fix the spelling mistakes',
    ], edit());

    $result = $client->edits()->create([
        'object' => 'edit',
        'created' => 1664135921,
        'choices' => [],
    ]);

    expect($result)->toBeArray()->toBe(edit());
});
