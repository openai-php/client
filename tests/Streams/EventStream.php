<?php

use GuzzleHttp\Psr7\Utils;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\Streams\EventStream;

test('read data stream', function () {
    $stream = new EventStream(Utils::streamFor('data: {"text": "Hey!"}'));

    expect(iterator_to_array($stream->read())[0])->toBe(['text' => 'Hey!']);
});

test('skips empty stream lines', function () {
    $stream = new EventStream(Utils::streamFor("data: {\"text\": \"Hey\"}\n\ndata: {\"text\": \"there!\"}"));

    expect(iterator_to_array($stream->read()))->toBe([['text' => 'Hey'], ['text' => 'there!']]);
});

test('aborts after done message', function () {
    $stream = new EventStream(Utils::streamFor("data: {\"text\": \"Hey\"}\ndata: [DONE]\ndata: {\"text\": \"there!\"}"));

    expect(iterator_to_array($stream->read()))->toBe([['text' => 'Hey']]);
});

test('stream message serialization error', function () {
    $stream = new EventStream(Utils::streamFor("data: invalid"));

    iterator_to_array($stream->read());
})->throws(UnserializableResponse::class);

test('stream message error', function () {
    $stream = new EventStream(Utils::streamFor('data: ' . json_encode(['error' => [
        'message' => 'Something went wrong.',
        'type' => 'invalid_request_error',
        'param' => null,
        'code' => 'invalid_request_error',
    ]])));

    iterator_to_array($stream->read());
})->throws(ErrorException::class, 'Something went wrong');
