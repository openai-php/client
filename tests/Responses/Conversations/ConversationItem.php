<?php

use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\Objects\Message;
use OpenAI\Responses\Responses\Input\ApplyPatchToolCallOutput;
use OpenAI\Responses\Responses\Output\OutputApplyPatchToolCall;
use OpenAI\Responses\Responses\Output\OutputProgram;
use OpenAI\Responses\Responses\Output\OutputProgramOutput;

test('from', function () {
    $response = ConversationItem::from(conversationItemResource());

    expect($response)
        ->toBeInstanceOf(ConversationItem::class)
        ->item->toBeInstanceOf(Message::class)
        ->item->id->toBe('msg_abc');
});

test('as array accessible', function () {
    $response = ConversationItem::from(conversationItemResource());

    expect($response['id'])
        ->toBe('msg_abc');
});

test('to array', function () {
    $response = ConversationItem::from(conversationItemResource());

    expect($response->toArray())
        ->toBe(conversationItemResource());
});

test('from program item', function () {
    $response = ConversationItem::from(outputProgram());

    expect($response)
        ->item->toBeInstanceOf(OutputProgram::class)
        ->item->callId->toBe('call_prog_123')
        ->toArray()->toBe(outputProgram());
});

test('from program output item', function () {
    $response = ConversationItem::from(outputProgramOutput());

    expect($response)
        ->item->toBeInstanceOf(OutputProgramOutput::class)
        ->item->callId->toBe('call_prog_123')
        ->toArray()->toBe(outputProgramOutput());
});

test('from with apply patch call', function () {
    $response = ConversationItem::from(outputApplyPatchToolCall());

    expect($response->item)
        ->toBeInstanceOf(OutputApplyPatchToolCall::class)
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('from with apply patch call output', function () {
    $response = ConversationItem::from(applyPatchToolCallOutputItem());

    expect($response->item)
        ->toBeInstanceOf(ApplyPatchToolCallOutput::class)
        ->status->toBe('failed');
});
