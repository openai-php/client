<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\StreamDecoratorTrait;
use GuzzleHttp\Psr7\Utils;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\Output\OutputCompaction;
use OpenAI\Responses\StreamResponse;
use Psr\Http\Message\StreamInterface;

final class StreamResponseReadTrackingStream implements StreamInterface
{
    use StreamDecoratorTrait;

    private StreamInterface $stream;

    public int $readCalls = 0;

    public int $largestRead = 0;

    public ?int $emptyReadCall = null;

    public ?int $maximumBytesPerRead = null;

    public function read($length): string
    {
        $this->readCalls++;
        $this->largestRead = max($this->largestRead, $length);

        if ($this->readCalls === $this->emptyReadCall) {
            return '';
        }

        if ($this->maximumBytesPerRead !== null) {
            $length = min($length, $this->maximumBytesPerRead);
        }

        return $this->stream->read($length);
    }
}

test('reads large SSE events in chunks without losing buffered events', function () {
    $largeEncryptedContent = str_repeat('a', 128 * 1024);

    $events = [
        [
            'type' => 'response.output_item.done',
            'output_index' => 0,
            'sequence_number' => 1,
            'item' => [
                'id' => 'cmp_large',
                'encrypted_content' => $largeEncryptedContent,
                'type' => 'compaction',
                'created_by' => 'user',
            ],
        ],
        [
            'type' => 'response.output_item.done',
            'output_index' => 1,
            'sequence_number' => 2,
            'item' => [
                'id' => 'cmp_buffered',
                'encrypted_content' => 'buffered content',
                'type' => 'compaction',
                'created_by' => 'user',
            ],
        ],
    ];

    $body = implode('', array_map(
        fn (array $event): string => "event: response.output_item.done\n".
            'data: '.json_encode($event, flags: JSON_THROW_ON_ERROR)."\n\n",
        $events,
    )).'data: [DONE]';

    $stream = new StreamResponseReadTrackingStream(Utils::streamFor($body));
    $response = new Response(body: $stream);
    $streamResponse = new StreamResponse(CreateStreamedResponse::class, $response);

    $result = iterator_to_array($streamResponse);

    expect($result)
        ->toHaveCount(2)
        ->and($result[0]->response->item)
        ->toBeInstanceOf(OutputCompaction::class)
        ->encryptedContent->toBe($largeEncryptedContent)
        ->and($result[1]->response->item)
        ->toBeInstanceOf(OutputCompaction::class)
        ->encryptedContent->toBe('buffered content')
        ->and($stream->largestRead)->toBe(64 * 1024)
        ->and($stream->readCalls)->toBeLessThan(10);
});

test('retries an empty read before EOF without losing the buffered line', function () {
    $attributes = [
        'type' => 'response.output_item.done',
        'output_index' => 0,
        'sequence_number' => 1,
        'item' => [
            'id' => 'cmp_after_empty_read',
            'encrypted_content' => 'complete content',
            'type' => 'compaction',
            'created_by' => 'user',
        ],
    ];
    $body = 'data: '.json_encode($attributes, flags: JSON_THROW_ON_ERROR)."\n";

    $stream = new StreamResponseReadTrackingStream(Utils::streamFor($body));
    $stream->maximumBytesPerRead = 10;
    $stream->emptyReadCall = 2;

    $response = new Response(body: $stream);
    $streamResponse = new StreamResponse(CreateStreamedResponse::class, $response);

    $result = iterator_to_array($streamResponse);

    expect($result)
        ->toHaveCount(1)
        ->and($result[0]->response->item)
        ->toBeInstanceOf(OutputCompaction::class)
        ->encryptedContent->toBe('complete content');
});
