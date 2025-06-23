<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\ReferencePromptObject;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'responses', [
        'model' => 'gpt-4o',
        'tools' => [['type' => 'web_search_preview']],
        'input' => 'what was a positive news story from today?',
    ], \OpenAI\ValueObjects\Transporter\Response::from(createResponseResource(), metaHeaders()));

    $result = $client->responses()->create([
        'model' => 'gpt-4o',
        'tools' => [['type' => 'web_search_preview']],
        'input' => 'what was a positive news story from today?',
    ]);

    $output = $result->output;
    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response')
        ->createdAt->toBe(1741484430)
        ->status->toBe('completed')
        ->error->toBeNull()
        ->incompleteDetails->toBeNull()
        ->instructions->toBeNull()
        ->maxOutputTokens->toBeNull()
        ->model->toBe('gpt-4o-2024-08-06')
        ->output->toBeArray()
        ->output->toHaveCount(6);

    expect($output[0])
        ->type->toBe('message')
        ->id->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->status->toBe('completed')
        ->role->toBe('assistant')
        ->content->toBeArray()
        ->content->toHaveCount(2);

    expect($output[0]['content'][0])
        ->type->toBe('output_text')
        ->text->toBe('As of today, March 9, 2025, one notable positive news story...');

    expect($output[1])
        ->type->toBe('web_search_call')
        ->id->toBe('ws_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->status->toBe('completed');

    expect($output[4])
        ->type->toBe('reasoning');

    expect($result)
        ->parallelToolCalls->toBeTrue()
        ->previousResponseId->toBeNull()
        ->temperature->toBe(1.0)
        ->toolChoice->toBe('auto')
        ->topP->toBe(1.0)
        ->truncation->toBe('disabled');

    expect($result->truncation)
        ->toBe('disabled');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create with stored prompt.', function () {
    $client = mockClient('POST', 'responses', [
        'model' => 'gpt-4o',
        'input' => 'what was a positive news story from today?',
    ], \OpenAI\ValueObjects\Transporter\Response::from(createResponseStoredPromptResource(), metaHeaders()));

    $result = $client->responses()->create([
        'model' => 'gpt-4o',
        'input' => 'what was a positive news story from today?',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->instructions->toBeArray()
        ->prompt->toBeInstanceOf(ReferencePromptObject::class);
});

test('create throws an exception if stream option is true', function () {
    OpenAI::client('foo')->responses()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ]);
})->throws(OpenAI\Exceptions\InvalidArgumentException::class, 'Stream option is not supported. Please use the createStreamed() method instead.');

test('create streamed', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(responseCompletionStream()),
    );

    $client = mockStreamClient('POST', 'responses', [
        'model' => 'gpt-4o',
        'tools' => [['type' => 'web_search_preview']],
        'input' => 'what was a positive news story from today?',
        'stream' => true,
    ], $response);

    $result = $client->responses()->createStreamed([
        'model' => 'gpt-4o',
        'tools' => [['type' => 'web_search_preview']],
        'input' => 'what was a positive news story from today?',
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    $current = $result->getIterator()->current();
    expect($current)
        ->toBeInstanceOf(CreateStreamedResponse::class);
    expect($current->event)
        ->toBe('response.created');
    expect($current->response)
        ->toBeInstanceOf(CreateResponse::class);
    expect($current->response->id)
        ->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
    expect($current->response->object)
        ->toBe('response');
    expect($current->response->createdAt)
        ->toBe(1741484430);
    expect($current->response->status)
        ->toBe('in_progress');
    expect($current->response->error)
        ->toBeNull();
    expect($current->response->incompleteDetails)
        ->toBeNull();
    expect($current->response->instructions)
        ->toBeNull();
    expect($current->response->maxOutputTokens)
        ->toBeNull();
    expect($current->response->model)
        ->toBe('gpt-4o-2024-08-06');
    expect($current->response->output)
        ->toBeArray();
    expect($current->response->output)
        ->toHaveCount(0);
    expect($current->response->parallelToolCalls)
        ->toBeTrue();
    expect($current->response->previousResponseId)
        ->toBeNull();
    expect($current->response->temperature)
        ->toBe(1.0);
    expect($current->response->toolChoice)
        ->toBe('auto');
    expect($current->response->topP)
        ->toBe(1.0);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create streamed image generation', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(responseImageGenerationStream()),
    );

    $client = mockStreamClient('POST', 'responses', [
        'model' => 'gpt-4.1-mini',
        'input' => 'A single black line forming a perfect circle on a white background.',
        'tools' => [
            [
                'type' => 'image_generation',
                'size' => '1024x1024',
                'quality' => 'low',
                'partial_images' => 1,
            ],
        ],
        'stream' => true,
    ], $response);

    $result = $client->responses()->createStreamed([
        'model' => 'gpt-4.1-mini',
        'input' => 'A single black line forming a perfect circle on a white background.',
        'tools' => [
            [
                'type' => 'image_generation',
                'size' => '1024x1024',
                'quality' => 'low',
                'partial_images' => 1,
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    foreach ($result as $event) {
        expect($event)
            ->toBeInstanceOf(CreateStreamedResponse::class);
    }
});

test('create streamed code interpreter', function () {
    $response = new Response(
        headers: metaHeaders(),
        body: new Stream(responseCodeInterpreterStream()),
    );

    $client = mockStreamClient('POST', 'responses', [
        'model' => 'gpt-4o-mini',
        'instructions' => 'You are a personal math tutor. When asked a math question, write and run code to answer the question.',
        'input' => 'I need to solve the equation 3x + 11 = 14. Can you help me?',
        'tools' => [
            [
                'type' => 'code_interpreter',
                'container' => [
                    'type' => 'auto',
                ],
            ],
        ],
        'stream' => true,
    ], $response);

    $result = $client->responses()->createStreamed([
        'model' => 'gpt-4o-mini',
        'instructions' => 'You are a personal math tutor. When asked a math question, write and run code to answer the question.',
        'input' => 'I need to solve the equation 3x + 11 = 14. Can you help me?',
        'tools' => [
            [
                'type' => 'code_interpreter',
                'container' => [
                    'type' => 'auto',
                ],
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class)
        ->and($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    foreach ($result as $event) {
        expect($event)
            ->toBeInstanceOf(CreateStreamedResponse::class);
    }
});

test('delete', function () {
    $client = mockClient('DELETE', 'responses/resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c', [
    ], \OpenAI\ValueObjects\Transporter\Response::from(deleteResponseResource(), metaHeaders()));

    $result = $client->responses()->delete('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    expect($result)
        ->toBeInstanceOf(DeleteResponse::class)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'responses/resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c/input_items', [
    ], \OpenAI\ValueObjects\Transporter\Response::from(listInputItemsResource(), metaHeaders()));

    $result = $client->responses()->list('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    expect($result)
        ->toBeInstanceOf(ListInputItems::class)
        ->object->toBe('list')
        ->data->toBeArray()
        ->firstId->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->lastId->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'responses/resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c', [
    ], \OpenAI\ValueObjects\Transporter\Response::from(retrieveResponseResource(), metaHeaders()));

    $result = $client->responses()->retrieve('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response')
        ->createdAt->toBe(1741484430)
        ->status->toBe('completed');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('cancel', function () {
    $client = mockClient('POST', 'responses/resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c/cancel', [
    ], \OpenAI\ValueObjects\Transporter\Response::from(retrieveResponseResource(), metaHeaders()));

    $result = $client->responses()->cancel('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response')
        ->createdAt->toBe(1741484430)
        ->status->toBe('completed');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
