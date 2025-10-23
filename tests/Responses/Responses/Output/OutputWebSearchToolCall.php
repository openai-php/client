<?php

use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use OpenAI\Responses\Responses\Output\WebSearch\OutputWebSearchAction;

test('from with full action', function () {
    $response = OutputWebSearchToolCall::from(outputWebSearchToolCall());

    expect($response)
        ->toBeInstanceOf(OutputWebSearchToolCall::class)
        ->id->toBe('ws_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->status->toBe('completed')
        ->type->toBe('web_search_call')
        ->action->toBeInstanceOf(OutputWebSearchAction::class)
        ->action->query->toBe('what was a positive news story from today?')
        ->action->sources->toBeArray()
        ->action->sources->toHaveCount(2);

    // Ensure first source is parsed correctly
    expect($response->action->sources[0])
        ->type->toBe('url')
        ->url->toBe('https://example.com/news/positive-story');
});

test('as array accessible', function () {
    $response = OutputWebSearchToolCall::from(outputWebSearchToolCall());

    expect($response['id'])->toBe('ws_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
});

test('to array with full action', function () {
    $response = OutputWebSearchToolCall::from(outputWebSearchToolCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputWebSearchToolCall());
});

test('from without action', function () {
    $payload = outputWebSearchToolCall();
    unset($payload['action']);

    $response = OutputWebSearchToolCall::from($payload);

    expect($response)
        ->toBeInstanceOf(OutputWebSearchToolCall::class)
        ->id->toBe('ws_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->status->toBe('completed')
        ->type->toBe('web_search_call')
        ->action->toBeNull();

    expect($response->toArray())
        ->toBeArray()
        ->toBe($payload)
        ->not->toHaveKey('action');
});

test('from with action but without query', function () {
    $payload = outputWebSearchToolCall();
    unset($payload['action']['query']);

    $response = OutputWebSearchToolCall::from($payload);

    expect($response)
        ->toBeInstanceOf(OutputWebSearchToolCall::class)
        ->action->toBeInstanceOf(OutputWebSearchAction::class)
        ->action->query->toBeNull()
        ->action->sources->toHaveCount(2);

    $array = $response->toArray();
    expect($array)
        ->toBeArray()
        ->toBe($payload);

    expect($array['action'])
        ->toBeArray()
        ->not->toHaveKey('query');
});

test('from with action but without query & sources', function () {
    $payload = outputWebSearchToolCall();
    unset($payload['action']['query']);
    unset($payload['action']['sources']);

    $response = OutputWebSearchToolCall::from($payload);

    expect($response)
        ->toBeInstanceOf(OutputWebSearchToolCall::class)
        ->action->toBeInstanceOf(OutputWebSearchAction::class)
        ->action->query->toBeNull()
        ->action->sources->toBeNull();

    $array = $response->toArray();
    expect($array)
        ->toBeArray()
        ->toBe($payload);

    expect($array['action'])
        ->toBeArray()
        ->not->toHaveKey('query')
        ->not->toHaveKey('sources');
});
