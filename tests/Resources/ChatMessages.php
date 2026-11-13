<?php

use OpenAI\Responses\Chat\ListMessagesResponse;
use OpenAI\Responses\Chat\ListMessagesResponseContentPart;
use OpenAI\Responses\Chat\ListMessagesResponseMessage;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('list', function () {
    $client = mockClient('GET', 'chat/completions/chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2/messages', [
        'after' => 'chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2-2',
        'limit' => 10,
        'order' => 'desc',
    ], Response::from(chatCompletionMessages(), metaHeaders()));

    $result = $client->chat()->messages()->list('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2', [
        'after' => 'chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2-2',
        'limit' => 10,
        'order' => 'desc',
    ]);

    expect($result)
        ->toBeInstanceOf(ListMessagesResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(ListMessagesResponseMessage::class)
        ->firstId->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2-0')
        ->lastId->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2-1')
        ->hasMore->toBeFalse();

    expect($result->data[0])
        ->id->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2-0')
        ->role->toBe('user')
        ->content->toBe('What is in this image?')
        ->name->toBeNull()
        ->contentParts->toHaveCount(2)
        ->contentParts->each->toBeInstanceOf(ListMessagesResponseContentPart::class);

    expect($result->data[0]->contentParts[1])
        ->type->toBe('image_url')
        ->text->toBeNull()
        ->imageUrl->toBe(['url' => 'https://example.com/cat.png', 'detail' => 'auto']);

    expect($result->data[1])
        ->role->toBe('developer')
        ->contentParts->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
