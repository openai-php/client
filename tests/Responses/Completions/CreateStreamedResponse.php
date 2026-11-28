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

test('from with system fingerprint', function () {
    $chunk = CreateStreamedResponse::from(completionStreamChunkWithSystemFingerprint());

    expect($chunk->systemFingerprint)->toBe('fp_44709d6fcb')
        ->and($chunk->toArray())->toHaveKey('system_fingerprint', 'fp_44709d6fcb');
});

test('from without system fingerprint', function () {
    $data = completionStreamChunkWithSystemFingerprint();
    unset($data['system_fingerprint']);
    $chunk = CreateStreamedResponse::from($data);

    expect($chunk->systemFingerprint)->toBeNull()
        ->and($chunk->toArray())->not->toHaveKey('system_fingerprint');
});
