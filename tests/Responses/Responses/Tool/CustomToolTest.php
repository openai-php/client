<?php

use OpenAI\Responses\Responses\Tool\CustomTool;
use OpenAI\Responses\Responses\Tool\CustomToolInputs\TextInput;
use OpenAI\Responses\Responses\Tool\NamespaceTool;
use OpenAI\Responses\Responses\Tool\NamespaceTools\CustomTool as NamespaceCustomTool;

test('from with custom tool', function () {
    $response = CustomTool::from(toolCustom());

    expect($response)
        ->toBeInstanceOf(CustomTool::class)
        ->name->toBe('my_custom_tool')
        ->type->toBe('custom')
        ->deferLoading->toBeFalse()
        ->description->toBe('A custom tool.')
        ->format->toBeInstanceOf(TextInput::class)
        ->format->type->toBe('text');
});

test('to array with custom tool', function () {
    $response = CustomTool::from(toolCustom());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolCustom());
});

test('namespace tool with custom tool', function () {
    $data = toolNamespace();
    $data['tools'] = [
        toolCustom(),
    ];

    $response = NamespaceTool::from($data);

    expect($response)
        ->toBeInstanceOf(NamespaceTool::class)
        ->tools->toHaveCount(1)
        ->tools->{0}->toBeInstanceOf(NamespaceCustomTool::class);

    expect($response->toArray())
        ->toBe($data);
});
