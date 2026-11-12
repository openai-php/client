<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\InvalidArgumentException;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseUsage;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\Chat\CreateStreamedResponseChoice;
use OpenAI\Responses\Chat\DeleteResponse;
use OpenAI\Responses\Chat\ListResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ], OpenAI\ValueObjects\Transporter\Response::from(chatCompletion(), metaHeaders()));

    $result = $client->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1677652288)
        ->model->toBe('gpt-3.5-turbo')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->choices[0])
        ->message->role->toBe('assistant')
        ->message->content->toBe("\n\nHello there, how may I assist you today?")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBe('stop');

    expect($result->usage)
        ->promptTokens->toBe(9)
        ->completionTokens->toBe(12)
        ->totalTokens->toBe(21);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create throws an exception if stream option is true', function () {
    OpenAI::client('foo')->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ]);
})->throws(InvalidArgumentException::class, 'Stream option is not supported. Please use the createStreamed() method instead.');

test('create streamed', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(chatCompletionStream()),
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $result = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    expect($result->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz')
        ->object->toBe('chat.completion.chunk')
        ->created->toBe(1679432086)
        ->model->toBe('gpt-4-0314')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateStreamedResponseChoice::class)
        ->usage->toBeNull();

    expect($result->getIterator()->current()->choices[0])
        ->delta->role->toBeNull()
        ->delta->content->toBe('Hello')
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);

    foreach ($result->getIterator() as $response) {
        expect($response)
            ->toBeInstanceOf(CreateStreamedResponse::class);
    }
});

test('handles ping messages in stream', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(chatCompletionStreamPing()),
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $stream = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    foreach ($stream as $response) {
        expect($response)
            ->toBeInstanceOf(CreateStreamedResponse::class);
    }
});

test('handles keepalive messages in stream', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(chatCompletionStreamKeepAlive()),
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $stream = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    foreach ($stream as $response) {
        expect($response)
            ->toBeInstanceOf(CreateStreamedResponse::class);
    }
});

test('handles error messages in stream', function () {
    $response = new Response(
        body: new Stream(chatCompletionStreamError())
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $result = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect(fn () => $result->getIterator()->current())
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('server_error');
        });
});

test('list', function () {
    $client = mockClient('GET', 'chat/completions', [
        'model' => 'gpt-4o',
        'metadata' => ['topic' => 'greeting'],
        'limit' => 10,
        'order' => 'desc',
    ], OpenAI\ValueObjects\Transporter\Response::from([
        'object' => 'list',
        'data' => [chatCompletionStored()],
        'first_id' => 'chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2',
        'last_id' => 'chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2',
        'has_more' => false,
    ], metaHeaders()));

    $result = $client->chat()->list([
        'model' => 'gpt-4o',
        'metadata' => ['topic' => 'greeting'],
        'limit' => 10,
        'order' => 'desc',
    ]);

    expect($result)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1)
        ->data->each->toBeInstanceOf(CreateResponse::class)
        ->firstId->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2')
        ->lastId->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2')
        ->hasMore->toBeFalse();

    expect($result->data[0])
        ->id->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2')
        ->model->toBe('gpt-4o-2024-08-06');

    expect($result->data[0]->choices[0]->message)
        ->content->toBe('Hello! How can I help you today?')
        ->toolCalls->toBe([])
        ->functionCall->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'chat/completions/chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2', [], OpenAI\ValueObjects\Transporter\Response::from(chatCompletionStored(), metaHeaders()));

    $result = $client->chat()->retrieve('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2');

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2')
        ->object->toBe('chat.completion')
        ->created->toBe(1738960610)
        ->systemFingerprint->toBe('fp_50cad350e4')
        ->usage->totalTokens->toBe(31);

    expect($result->choices[0])
        ->message->content->toBe('Hello! How can I help you today?')
        ->finishReason->toBe('stop');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('update', function () {
    $client = mockClient('POST', 'chat/completions/chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2', [
        'metadata' => ['topic' => 'greeting'],
    ], OpenAI\ValueObjects\Transporter\Response::from(chatCompletionStored(), metaHeaders()));

    $result = $client->chat()->update('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2', [
        'metadata' => ['topic' => 'greeting'],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'chat/completions/chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2', [], OpenAI\ValueObjects\Transporter\Response::from(chatCompletionDeleted(), metaHeaders()));

    $result = $client->chat()->delete('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2');

    expect($result)
        ->toBeInstanceOf(DeleteResponse::class)
        ->id->toBe('chatcmpl-AyPNinnUqUDYo9SAdA52NobMflmj2')
        ->object->toBe('chat.completion.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
