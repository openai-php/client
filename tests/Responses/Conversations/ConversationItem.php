<?php

use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\Objects\Message;
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
