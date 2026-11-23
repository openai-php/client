<?php

use OpenAI\Responses\Responses\Output\OutputReasoning;

test('from', function () {
    $response = OutputReasoning::from(outputReasoning());

    expect($response)
        ->toBeInstanceOf(OutputReasoning::class)
        ->summary->toBeArray()
        ->id->toBe('rs_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->type->toBe('reasoning')
        ->encryptedContent->toBe('aabbccddeeff')
        ->status->toBe('completed');
});

test('from no status', function () {
    $payload = outputReasoning();
    unset($payload['status']);

    $response = OutputReasoning::from($payload);

    expect($response)
        ->toBeInstanceOf(OutputReasoning::class)
        ->summary->toBeArray()
        ->id->toBe('rs_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->type->toBe('reasoning')
        ->encryptedContent->toBe('aabbccddeeff')
        ->status->toBeNull();
});

test('as array accessible', function () {
    $response = OutputReasoning::from(outputReasoning());

    expect($response['id'])->toBe('rs_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c');
});

test('to array', function () {
    $response = OutputReasoning::from(outputReasoning());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputReasoning());
});

test('from with null reasoning item content', function () {
    $payload = outputReasoning();
    $payload['content'] = null;

    $response = OutputReasoning::from($payload);

    expect($response->content)->toBeNull()
        ->and($response->toArray())->toBe(outputReasoning());
});

test('from with reasoning item content', function () {
    $payload = outputReasoning();
    $content = [
        [
            'text' => 'The user asks for the capital of France.',
            'type' => 'reasoning_text',
        ],
    ];
    $payload = [
        'id' => $payload['id'],
        'summary' => $payload['summary'],
        'type' => $payload['type'],
        'content' => $content,
        'encrypted_content' => $payload['encrypted_content'],
        'status' => $payload['status'],
    ];

    $response = OutputReasoning::from($payload);

    expect($response->content)->toBeArray()
        ->and($response->content[0]->text)->toBe('The user asks for the capital of France.')
        ->and($response->content[0]->type)->toBe('reasoning_text')
        ->and($response->toArray())->toBe($payload);
});
