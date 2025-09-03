<?php

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\Streaming\ReasoningTextDelta;
use OpenAI\Responses\Responses\Streaming\ReasoningTextDone;

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('resp_67c9fdcecf488190bdd9a0409de3a1ec07b8b0ad4e5eb654');
});

test('from', function () {
    $response = CreateStreamedResponse::fake(responseCompletionSteamCreatedEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.created')
        ->response->toBeInstanceOf(CreateResponse::class)
        ->response->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('reasoning text delta event', function () {
    $response = CreateStreamedResponse::fake(responseReasoningTextDeltaEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.reasoning_text.delta')
        ->response->toBeInstanceOf(ReasoningTextDelta::class)
        ->response->delta->toBe('Let me analyze')
        ->response->itemId->toBe('item_123')
        ->response->outputIndex->toBe(0)
        ->response->contentIndex->toBe(0)
        ->response->sequenceNumber->toBe(5);
});

test('reasoning text done event', function () {
    $response = CreateStreamedResponse::fake(responseReasoningTextDoneEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.reasoning_text.done')
        ->response->toBeInstanceOf(ReasoningTextDone::class)
        ->response->text->toBe('Let me analyze this problem step by step to provide the best solution.')
        ->response->itemId->toBe('item_123')
        ->response->outputIndex->toBe(0)
        ->response->contentIndex->toBe(0)
        ->response->sequenceNumber->toBe(10);
});
