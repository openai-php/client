<?php

use GuzzleHttp\Psr7\Utils;
use OpenAI\Streams\EventStream;
use OpenAI\Streams\Stream;

test('stream iterator', function () {
    $stream = new Stream(
        new EventStream(Utils::streamFor("data: {\"text\": \"Hey \"}\ndata: {\"text\": \"there!\"}")),
        function ($data) {
            $data['test'] = true;

            return $data;
        },
    );

    expect(iterator_to_array($stream->read()))->toBe([
        ['text' => 'Hey ', 'test' => true],
        ['text' => 'there!', 'test' => true],
    ]);
});
