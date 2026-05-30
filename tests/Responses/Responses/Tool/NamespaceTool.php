<?php

use OpenAI\Responses\Responses\Tool\NamespaceTool;

test('from', function () {
    $response = NamespaceTool::from(toolNamespace());

    expect($response)
        ->toBeInstanceOf(NamespaceTool::class)
        ->description->toBe('A namespace of tools.')
        ->name->toBe('my_namespace')
        ->tools->toBeArray()
        ->type->toBe('namespace');
});

test('as array accessible', function () {
    $response = NamespaceTool::from(toolNamespace());

    expect($response['type'])->toBe('namespace');
});

test('to array', function () {
    $response = NamespaceTool::from(toolNamespace());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolNamespace());
});
