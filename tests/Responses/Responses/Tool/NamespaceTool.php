<?php

use OpenAI\Responses\Responses\Tool\NamespaceTool;
use OpenAI\Responses\Responses\Tool\NamespaceTools\FunctionTool;

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

test('function tool with programmatic configuration', function () {
    $data = toolNamespace();
    $data['tools'] = [[
        'name' => 'get_inventory',
        'parameters' => [
            'type' => 'object',
            'properties' => [
                'sku' => ['type' => 'string'],
            ],
            'required' => ['sku'],
            'additionalProperties' => false,
        ],
        'strict' => true,
        'type' => 'function',
        'description' => 'Return inventory for a SKU.',
        'allowed_callers' => ['programmatic'],
        'output_schema' => [
            'type' => 'object',
            'properties' => [
                'available_units' => ['type' => 'number'],
            ],
            'required' => ['available_units'],
            'additionalProperties' => false,
        ],
    ]];

    $response = NamespaceTool::from($data);

    expect($response->tools[0])
        ->toBeInstanceOf(FunctionTool::class)
        ->allowedCallers->toBe(['programmatic'])
        ->outputSchema->toBe($data['tools'][0]['output_schema']);

    expect($response->toArray())->toBe($data);
});
