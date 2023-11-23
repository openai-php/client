<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseUsage;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\Chat\CreateStreamedResponseChoice;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ], \OpenAI\ValueObjects\Transporter\Response::from(chatCompletion(), metaHeaders()));

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
})->throws(OpenAI\Exceptions\InvalidArgumentException::class, 'Stream option is not supported. Please use the createStreamed() method instead.');

test('create streamed', function () {
    $response = new Response(
        body: new Stream(chatCompletionStream()),
        headers: metaHeaders(),
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
        ->toThrow(function (OpenAI\Exceptions\ErrorException $e) {
            expect($e->getMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('server_error');
        });
});
