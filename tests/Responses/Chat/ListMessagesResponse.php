<?php

use OpenAI\Responses\Chat\ListMessagesResponse;
use OpenAI\Responses\Chat\ListMessagesResponseMessage;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = ListMessagesResponse::from(chatCompletionMessages(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toHaveCount(2)
        ->data->each->toBeInstanceOf(ListMessagesResponseMessage::class)
        ->firstId->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2-0')
        ->lastId->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2-1')
        ->hasMore->toBeFalse()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ListMessagesResponse::from(chatCompletionMessages(), meta());

    expect($result['object'])->toBe('list');
});

test('to array', function () {
    $result = ListMessagesResponse::from(chatCompletionMessages(), meta());

    expect($result->toArray())
        ->toBe(chatCompletionMessages());
});

test('preserves audio and file content parts', function () {
    $page = chatCompletionMessages();
    $page['data'][0]['content_parts'] = [
        ['type' => 'input_audio', 'input_audio' => ['data' => 'YXVkaW8=', 'format' => 'wav']],
        ['type' => 'file', 'file' => ['file_id' => 'file-example', 'filename' => 'notes.pdf']],
    ];

    $result = ListMessagesResponse::from($page, meta());

    expect($result->data[0]->contentParts[0]->inputAudio)
        ->toBe(['data' => 'YXVkaW8=', 'format' => 'wav'])
        ->and($result->data[0]->contentParts[1]->file)
        ->toBe(['file_id' => 'file-example', 'filename' => 'notes.pdf'])
        ->and($result->toArray())
        ->toBe($page);
});

test('handles an empty page with no cursors', function () {
    $page = [
        'object' => 'list',
        'data' => [],
        'first_id' => null,
        'last_id' => null,
        'has_more' => false,
    ];

    $result = ListMessagesResponse::from($page, meta());

    expect($result->toArray())->toBe($page);
});

test('fake', function () {
    $response = ListMessagesResponse::fake();

    expect($response)
        ->object->toBe('list')
        ->data->{0}->role->toBe('user');
});

test('fake with override', function () {
    $response = ListMessagesResponse::fake([
        'has_more' => true,
    ]);

    expect($response)
        ->hasMore->toBeTrue();
});
