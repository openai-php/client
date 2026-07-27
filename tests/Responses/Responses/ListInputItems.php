<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Input\CustomToolCallOutput;
use OpenAI\Responses\Responses\Input\FunctionToolCallOutput;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\Output\OutputProgram;
use OpenAI\Responses\Responses\Output\OutputProgramOutput;

test('from', function () {
    $result = ListInputItems::from(listInputItemsResource(), meta());

    expect($result)
        ->toBeInstanceOf(ListInputItems::class)
        ->object->toBe('list')
        ->data->toBeArray()
        ->data->toHaveCount(17)
        ->firstId->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->lastId->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->hasMore->toBeFalse()
        ->meta()->toBeInstanceOf(MetaInformation::class);

    expect($result->data)
        ->{13}->toBeInstanceOf(OutputProgram::class)
        ->{14}->toBeInstanceOf(OutputProgramOutput::class)
        ->{15}->toBeInstanceOf(FunctionToolCallOutput::class)
        ->{15}->caller->callerId->toBe('call_prog_123')
        ->{16}->toBeInstanceOf(CustomToolCallOutput::class)
        ->{16}->caller->callerId->toBe('call_prog_123');
});

test('as array accessible', function () {
    $result = ListInputItems::from(listInputItemsResource(), meta());

    expect($result['object'])->toBe('list');
});

test('to array', function () {
    $result = ListInputItems::from(listInputItemsResource(), meta());

    expect($result->toArray())
        ->toBeArray()
        ->toBe(listInputItemsResource());
});

test('fake', function () {
    $response = ListInputItems::fake();

    expect($response)
        ->object->toBe('list')
        ->firstId->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->hasMore->toBeFalse();
});

test('fake with override', function () {
    $response = ListInputItems::fake([
        'object' => 'custom_list',
        'first_id' => 'msg_1234',
        'has_more' => true,
    ]);

    expect($response)
        ->object->toBe('custom_list')
        ->firstId->toBe('msg_1234')
        ->hasMore->toBeTrue();
});
