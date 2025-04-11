# OpenAI PHP - Responses API

This document outlines the Responses API functionality added to the OpenAI PHP client.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
  - [Create Response](#create-response)
  - [Create Streamed Response](#create-streamed-response)
  - [Retrieve Response](#retrieve-response)
  - [Delete Response](#delete-response)
  - [List Responses](#list-responses)
- [Testing](#testing)
  - [Response Fakes](#response-fakes)
  - [Response Assertions](#response-assertions)

## Installation

The Responses API is included in the OpenAI PHP client. No additional installation is required beyond the base package:

```bash
composer require openai-php/client
```

## Usage

### Create Response

Creates a model response. Provide text or image inputs to generate text or JSON outputs. Have the model call your own custom code or use built-in tools like web search or file search to use your own data as input for the model's response.

```php
$response = $client->responses()->create([
    'model' => 'gpt-4o-mini',
    'tools' => [
        [
            'type' => 'web_search_preview'
        ]
    ],
    'input' => "what was a positive news story from today?",
    'temperature' => 0.7,
    'max_output_tokens' => 150,
    'tool_choice' => 'auto',
    'parallel_tool_calls' => true,
    'store' => true,
    'metadata' => [
        'user_id' => '123',
        'session_id' => 'abc456'
    ]
]);

$response->id; // 'resp_67ccd2bed1ec8190b14f964abc054267'
$response->object; // 'response'
$response->createdAt; // 1741476542
$response->status; // 'completed'
$response->model; // 'gpt-4o-mini'

// Access output content
foreach ($response->output as $output) {
    $output->type; // 'message'
    $output->id; // 'msg_67ccd2bf17f0819081ff3bb2cf6508e6'
    $output->status; // 'completed'
    $output->role; // 'assistant'
    
    foreach ($output->content as $content) {
        $content->type; // 'output_text'
        $content->text; // The response text
        $content->annotations; // Any annotations in the response
    }
}

// Access usage information
$response->usage->inputTokens; // 36
$response->usage->outputTokens; // 87
$response->usage->totalTokens; // 123

$response->toArray(); // ['id' => 'resp_67ccd2bed1ec8190b14f964abc054267', ...]
```

### Create Streamed Response

When you create a Response with stream set to true, the server will emit server-sent events to the client as the Response is generated.

```php
$stream = $client->responses()->createStreamed([
    'model' => 'gpt-4o-mini',
    'tools' => [
        [
            'type' => 'web_search_preview'
        ]
    ],
    'input' => "what was a positive news story from today?",
    'stream' => true
]);

foreach ($stream as $response) {
    $response->id; // 'resp_67ccd2bed1ec8190b14f964abc054267'
    $response->object; // 'response'
    $response->createdAt; // 1741476542
    
    foreach ($response->output as $output) {
        // Process streaming output
        echo $output->content[0]->text;
    }
}
```

### Retrieve Response

Retrieves a model response with the given ID.

```php
$response = $client->responses()->retrieve('resp_67ccd2bed1ec8190b14f964abc054267');

$response->id; // 'resp_67ccd2bed1ec8190b14f964abc054267'
$response->object; // 'response'
$response->createdAt; // 1741476542
$response->status; // 'completed'
$response->error; // null
$response->incompleteDetails; // null
$response->instructions; // null
$response->maxOutputTokens; // null
$response->model; // 'gpt-4o-2024-08-06'
$response->parallelToolCalls; // true
$response->previousResponseId; // null
$response->store; // true
$response->temperature; // 1.0
$response->toolChoice; // 'auto'
$response->topP; // 1.0
$response->truncation; // 'disabled'

$response->toArray(); // ['id' => 'resp_67ccd2bed1ec8190b14f964abc054267', ...]
```

### Delete Response

Deletes a model response with the given ID.

```php
$response = $client->responses()->delete('resp_67ccd2bed1ec8190b14f964abc054267');

$response->id; // 'resp_67ccd2bed1ec8190b14f964abc054267'
$response->object; // 'response'
$response->deleted; // true

$response->toArray(); // ['id' => 'resp_67ccd2bed1ec8190b14f964abc054267', 'deleted' => true, ...]
```

### List Responses

Lists input items for a response with the given ID.

```php
$response = $client->responses()->list('resp_67ccd2bed1ec8190b14f964abc054267', [
    'limit' => 10,
    'order' => 'desc'
]);

$response->object; // 'list'

foreach ($response->data as $item) {
    $item->type; // 'message'
    $item->id; // Response item ID
    $item->status; // 'completed'
    $item->role; // 'user' or 'assistant'
    
    foreach ($item->content as $content) {
        $content->type; // Content type
        $content->text; // Content text
        $content->annotations; // Content annotations
    }
}

$response->firstId; // First item ID in the list
$response->lastId; // Last item ID in the list
$response->hasMore; // Whether there are more items to fetch

$response->toArray(); // ['object' => 'list', 'data' => [...], ...]
```

## Testing

### Response Fakes

The client includes fakes for testing response operations:

```php
use OpenAI\Testing\ClientFake;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;

// Test create operation
$fake = new ClientFake([
    CreateResponse::fake([
        'model' => 'gpt-4o-mini',
        'tools' => [
            [
                'type' => 'web_search_preview'
            ]
        ],
        'input' => "what was a positive news story from today?"
    ]),
]);

// Test retrieve operation
$fake = new ClientFake([
    RetrieveResponse::fake([
        'id' => 'resp_67ccd2bed1ec8190b14f964abc054267',
        'status' => 'completed'
    ]),
]);

// Test delete operation
$fake = new ClientFake([
    DeleteResponse::fake([
        'id' => 'resp_67ccd2bed1ec8190b14f964abc054267',
        'deleted' => true
    ]),
]);

// Test list operation
$fake = new ClientFake([
    ListInputItems::fake([
        'data' => [
            [
                'type' => 'message',
                'id' => 'msg_123',
                'status' => 'completed'
            ]
        ]
    ]),
]);
```

### Response Assertions

You can make assertions about the requests made to the Responses API:

```php
// Assert a specific create request was made
$fake->assertSent(Responses::class, function ($method, $parameters) {
    return $method === 'create' &&
        $parameters['model'] === 'gpt-4o-mini' &&
        $parameters['tools'][0]['type'] === 'web_search_preview' &&
        $parameters['input'] === "what was a positive news story from today?";
});

// Assert a specific retrieve request was made
$fake->assertSent(Responses::class, function ($method, $responseId) {
    return $method === 'retrieve' &&
        $responseId === 'resp_67ccd2bed1ec8190b14f964abc054267';
});

// Assert a specific delete request was made
$fake->assertSent(Responses::class, function ($method, $responseId) {
    return $method === 'delete' &&
        $responseId === 'resp_67ccd2bed1ec8190b14f964abc054267';
});

// Assert a specific list request was made
$fake->assertSent(Responses::class, function ($method, $responseId) {
    return $method === 'list' &&
        $responseId === 'resp_67ccd2bed1ec8190b14f964abc054267';
});

// Assert a request was not made
$fake->assertNotSent(Responses::class);

// Assert number of requests
$fake->assertSent(Responses::class, 2); // Assert exactly 2 requests were made
```

## Meta Information

Each response includes meta information about the request:

```php
$response = $client->responses()->create([/* ... */]);

$response->meta()->openai->model; // The model used
$response->meta()->openai->organization; // Your organization
$response->meta()->openai->version; // API version
$response->meta()->openai->processingMs; // Processing time in milliseconds
$response->meta()->requestId; // Request ID
$response->meta()->requestLimit->limit; // Rate limit info
$response->meta()->requestLimit->remaining; // Remaining requests
$response->meta()->requestLimit->reset; // Rate limit reset time
$response->meta()->tokenLimit->limit; // Token limit info
$response->meta()->tokenLimit->remaining; // Remaining tokens
$response->meta()->tokenLimit->reset; // Token limit reset time
```

This meta information is useful for debugging and tracking API usage.