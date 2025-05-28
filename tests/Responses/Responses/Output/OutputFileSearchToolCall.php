<?php

use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCallResult;

test('from', function () {
    $response = OutputFileSearchToolCall::from(outputFileSearchToolCall());

    expect($response)
        ->toBeInstanceOf(OutputFileSearchToolCall::class)
        ->id->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->queries->toBe(['map', 'kansas'])
        ->status->toBe('completed')
        ->type->toBe('file_search_call')
        ->results->toBeArray();
});

test('from results', function () {
    $response = OutputFileSearchToolCallResult::from(outputFileSearchToolCall()['results'][0]);

    expect($response)
        ->toBeInstanceOf(OutputFileSearchToolCallResult::class)
        ->attributes->toBe(['foo' => 'bar'])
        ->fileId->toBe('file_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->filename->toBe('kansas_map.geojson')
        ->score->toBe(0.98882)
        ->text->toBe('Map of Kansas');
});

test('as array accessible', function () {
    $response = OutputFileSearchToolCall::from(outputFileSearchToolCall());

    expect($response['id'])->toBe('fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputFileSearchToolCall::from(outputFileSearchToolCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputFileSearchToolCall());
});
