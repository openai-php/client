<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CompactedResponse;
use OpenAI\Responses\Responses\Input\InputMessage;
use OpenAI\Responses\Responses\Output\OutputCompaction;

test('from', function () {
    $result = CompactedResponse::from(compactedResponseResource(), meta());

    expect($result)
        ->id->toBe('resp_001')
        ->object->toBe('response.compaction')
        ->createdAt->toBe(1764967971)
        ->usage->inputTokens->toBe(139)
        ->meta()->toBeInstanceOf(MetaInformation::class);

    expect($result->output[0])->toBeInstanceOf(InputMessage::class)
        ->and($result->output[1])->toBeInstanceOf(OutputCompaction::class);
});

test('as array accessible', function () {
    $result = CompactedResponse::from(compactedResponseResource(), meta());

    expect($result['object'])
        ->toBe('response.compaction');
});

test('to array', function () {
    $result = CompactedResponse::from(compactedResponseResource(), meta());

    expect($result->toArray())
        ->toBe(compactedResponseResource());
});

test('fake', function () {
    $response = CompactedResponse::fake();

    expect($response)
        ->object->toBe('response.compaction')
        ->and($response->output[1])->toBeInstanceOf(OutputCompaction::class);
});

test('fake with override', function () {
    $response = CompactedResponse::fake([
        'id' => 'resp_1234',
    ]);

    expect($response)
        ->id->toBe('resp_1234');
});
