<?php

use OpenAI\Responses\Chat\DeleteResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = DeleteResponse::from(chatCompletionDeleted(), meta());

    expect($result)
        ->id->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2')
        ->object->toBe('chat.completion.deleted')
        ->deleted->toBeTrue()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = DeleteResponse::from(chatCompletionDeleted(), meta());

    expect($result['id'])
        ->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2');
});

test('to array', function () {
    $result = DeleteResponse::from(chatCompletionDeleted(), meta());

    expect($result->toArray())
        ->toBe(chatCompletionDeleted());
});

test('fake', function () {
    $response = DeleteResponse::fake();

    expect($response)
        ->id->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2')
        ->deleted->toBeTrue();
});

test('fake with override', function () {
    $response = DeleteResponse::fake([
        'id' => 'chatcmpl-123',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('chatcmpl-123')
        ->deleted->toBeFalse();
});
