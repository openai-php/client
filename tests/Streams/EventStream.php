<?php

use GuzzleHttp\Psr7\Utils;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\Streams\EventStream;

test('read data stream', function () {
    $jsonString = '{"text": "Hey!"}';

    $stream = new EventStream(Utils::streamFor("data: $jsonString"));

    $arr = iterator_to_array($stream->read());

    expect($arr[0])->toBe($jsonString);
});

test('skips empty stream lines', function () {
    $stream = new EventStream(Utils::streamFor("data: {\"text\": \"Hey\"}\n\ndata: {\"text\": \"there!\"}"));

    expect(iterator_to_array($stream->read()))->toBe(['{"text": "Hey"}', '{"text": "there!"}']);
});

test('aborts after done message', function () {
    $stream = new EventStream(Utils::streamFor("data: {\"text\": \"Hey\"}\ndata: [DONE]\ndata: {\"text\": \"there!\"}"));

    expect(iterator_to_array($stream->read()))->toBe(['{"text": "Hey"}']);
});
