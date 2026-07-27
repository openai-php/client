<?php

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\Output\OutputCompaction;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputProgram;
use OpenAI\Responses\Responses\Output\OutputProgramOutput;
use OpenAI\Responses\Responses\Output\OutputToolSearchCall;
use OpenAI\Responses\Responses\Output\OutputToolSearchOutput;
use OpenAI\Responses\Responses\Streaming\OutputItem;
use OpenAI\Responses\Responses\Streaming\RateLimits;
use OpenAI\Responses\Responses\Streaming\ReasoningTextDelta;
use OpenAI\Responses\Responses\Streaming\ReasoningTextDone;
use OpenAI\Responses\Responses\Streaming\Response;
use OpenAI\Responses\Responses\Tool\WebSearchTool;

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response->getIterator()->current()->response)
        ->toBeInstanceOf(Response::class)
        ->type->toBe('response.created')
        ->response->toBeInstanceOf(CreateResponse::class)
        ->response->id->toBe('resp_67c9fdcecf488190bdd9a0409de3a1ec07b8b0ad4e5eb654');
});

test('from', function () {
    $response = CreateStreamedResponse::fake(responseCompletionSteamCreatedEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.created')
        ->response->toBeInstanceOf(Response::class)
        ->response->type->toBe('response.created')
        ->response->response->toBeInstanceOf(CreateResponse::class)
        ->response->response->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
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

test('rate limits updated event', function () {
    $response = CreateStreamedResponse::fake(responseRateLimitsUpdatedEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.rate_limits.updated')
        ->response->toBeInstanceOf(RateLimits::class)
        ->response->toArray()->toBe([
            'type' => 'response.rate_limits.updated',
        ]);
});

test('output item done event with compaction item', function () {
    $response = CreateStreamedResponse::fake(responseOutputItemCompactionDoneEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.output_item.done')
        ->response->toBeInstanceOf(OutputItem::class)
        ->response->outputIndex->toBe(0)
        ->response->sequenceNumber->toBe(11)
        ->response->item->toBeInstanceOf(OutputCompaction::class)
        ->response->item->id->toBe('cmp_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->response->item->encryptedContent->toBe('encrypted_string_value')
        ->response->item->createdBy->toBe('user_123');
});

test('output item added event with program item', function () {
    $response = CreateStreamedResponse::from([
        'type' => 'response.output_item.added',
        'output_index' => 0,
        'sequence_number' => 1,
        'item' => outputProgram(),
        '__meta' => meta(),
    ]);

    expect($response)
        ->event->toBe('response.output_item.added')
        ->response->toBeInstanceOf(OutputItem::class)
        ->response->item->toBeInstanceOf(OutputProgram::class);
});

test('output item done event with program function call', function () {
    $response = CreateStreamedResponse::from([
        'type' => 'response.output_item.done',
        'output_index' => 1,
        'sequence_number' => 2,
        'item' => outputFunctionToolCallFromProgram(),
        '__meta' => meta(),
    ]);

    expect($response)
        ->event->toBe('response.output_item.done')
        ->response->toBeInstanceOf(OutputItem::class)
        ->response->item->toBeInstanceOf(OutputFunctionToolCall::class)
        ->response->item->caller->callerId->toBe('call_prog_123');
});

test('output item done event with program output item', function () {
    $response = CreateStreamedResponse::from([
        'type' => 'response.output_item.done',
        'output_index' => 2,
        'sequence_number' => 3,
        'item' => outputProgramOutput(),
        '__meta' => meta(),
    ]);

    expect($response)
        ->event->toBe('response.output_item.done')
        ->response->toBeInstanceOf(OutputItem::class)
        ->response->item->toBeInstanceOf(OutputProgramOutput::class);
});

test('output item added event with tool search call item', function () {
    $response = CreateStreamedResponse::fake(responseOutputItemToolSearchCallAddedEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.output_item.added')
        ->response->toBeInstanceOf(OutputItem::class)
        ->response->outputIndex->toBe(0)
        ->response->sequenceNumber->toBe(12)
        ->response->item->toBeInstanceOf(OutputToolSearchCall::class)
        ->response->item->id->toBe('tsc_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->response->item->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->response->item->type->toBe('tool_search_call');
});

test('output item done event with tool search output item', function () {
    $response = CreateStreamedResponse::fake(responseOutputItemToolSearchOutputDoneEvent());

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('response.output_item.done')
        ->response->toBeInstanceOf(OutputItem::class)
        ->response->outputIndex->toBe(1)
        ->response->sequenceNumber->toBe(13)
        ->response->item->toBeInstanceOf(OutputToolSearchOutput::class)
        ->response->item->id->toBe('tso_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->response->item->tools->toHaveCount(1)
        ->response->item->tools->{0}->toBeInstanceOf(WebSearchTool::class)
        ->response->item->type->toBe('tool_search_output');
});
