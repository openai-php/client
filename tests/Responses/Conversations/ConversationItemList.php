<?php

use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\ConversationItemList;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputProgram;
use OpenAI\Responses\Responses\Output\OutputProgramOutput;

test('from', function () {
    $response = ConversationItemList::from(conversationItemListResource(), meta());

    expect($response)
        ->toBeInstanceOf(ConversationItemList::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1)
        ->data->{0}->toBeInstanceOf(ConversationItem::class)
        ->firstId->toBe('msg_abc')
        ->lastId->toBe('msg_abc')
        ->hasMore->toBeFalse();

    expect($response->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = ConversationItemList::from(conversationItemListResource(), meta());

    expect($response['object'])
        ->toBe('list');
});

test('to array', function () {
    $response = ConversationItemList::from(conversationItemListResource(), meta());

    expect($response->toArray())
        ->toBe(conversationItemListResource());
});

test('from program items', function () {
    $attributes = conversationItemListResource();
    $attributes['data'] = [outputProgram(), outputProgramOutput()];

    $response = ConversationItemList::from($attributes, meta());

    expect($response->data)
        ->toHaveCount(2);
    expect($response->data[0]->item)->toBeInstanceOf(OutputProgram::class);
    expect($response->data[1]->item)->toBeInstanceOf(OutputProgramOutput::class);
    expect($response->toArray())->toBe($attributes);
});
