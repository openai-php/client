<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
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
        ->output->toHaveCount(4);

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

test('create streamed', function () {
    $response = new Response(
        body: new Stream(responseCompletionStream()),
        headers: metaHeaders(),
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
        ->toBe('completed');
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
        ->toHaveCount(2);
    expect($current->response->output[0]->type)
        ->toBe('web_search_call');
    expect($current->response->output[0]->id)
        ->toBe('ws_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c');
    expect($current->response->output[0]->status)
        ->toBe('completed');
    expect($current->response->output[1]->type)
        ->toBe('message');
    expect($current->response->output[1]->id)
        ->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c');
    expect($current->response->output[1]->status)
        ->toBe('completed');
    expect($current->response->output[1]->role)
        ->toBe('assistant');
    expect($current->response->output[1]->content)
        ->toBeArray();
    expect($current->response->output[1]->content)
        ->toHaveCount(1);
    expect($current->response->output[1]->content[0]->type)
        ->toBe('output_text');
    expect($current->response->output[1]->content[0]->text)
        ->toBe('As of today, March 9, 2025, one notable positive news story...');
    expect($current->response->output[1]->content[0]->annotations)
        ->toBeArray();
    expect($current->response->output[1]->content[0]->annotations)
        ->toHaveCount(3);
    expect($current->response->output[1]->content[0]->annotations[0]->type)
        ->toBe('url_citation');
    expect($current->response->output[1]->content[0]->annotations[0]->startIndex)
        ->toBe(442);
    expect($current->response->output[1]->content[0]->annotations[0]->endIndex)
        ->toBe(557);
    expect($current->response->output[1]->content[0]->annotations[0]->url)
        ->toBe('https://.../?utm_source=chatgpt.com');
    expect($current->response->output[1]->content[0]->annotations[0]->title)
        ->toBe('...');
    expect($current->response->output[1]->content[0]->annotations[1]->type)
        ->toBe('url_citation');
    expect($current->response->output[1]->content[0]->annotations[1]->startIndex)
        ->toBe(962);
    expect($current->response->output[1]->content[0]->annotations[1]->endIndex)
        ->toBe(1077);
    expect($current->response->output[1]->content[0]->annotations[1]->url)
        ->toBe('https://.../?utm_source=chatgpt.com');
    expect($current->response->output[1]->content[0]->annotations[1]->title)
        ->toBe('...');
    expect($current->response->output[1]->content[0]->annotations[2]->type)
        ->toBe('url_citation');
    expect($current->response->output[1]->content[0]->annotations[2]->startIndex)
        ->toBe(1336);
    expect($current->response->output[1]->content[0]->annotations[2]->endIndex)
        ->toBe(1451);
    expect($current->response->output[1]->content[0]->annotations[2]->url)
        ->toBe('https://.../?utm_source=chatgpt.com');
    expect($current->response->output[1]->content[0]->annotations[2]->title)
        ->toBe('...');
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
    expect($current->response->truncation)
        ->toBe('disabled');
    expect($current->response->reasoning)
        ->toBeArray();
    expect($current->response->reasoning['effort'])
        ->toBeNull();
    expect($current->response->reasoning['generate_summary'])
        ->toBeNull();
    expect($current->response->text)
        ->toBeArray();
    expect($current->response->text['format']['type'])
        ->toBe('text');
    expect($current->response->tools)
        ->toBeArray();
    expect($current->response->tools)
        ->toHaveCount(1);
    expect($current->response->tools[0]->type)
        ->toBe('web_search_preview');
    expect($current->response->tools[0]->domains)
        ->toBeArray()->toBeEmpty();
    expect($current->response->tools[0]->searchContextSize)
        ->toBe('medium');
    expect($current->response->tools[0]->userLocation)
        ->toBeArray();
    expect($current->response->tools[0]->userLocation['type'])
        ->toBe('approximate');
    expect($current->response->tools[0]->userLocation['city'])
        ->toBeNull();
    expect($current->response->tools[0]->userLocation['country'])
        ->toBe('US');
    expect($current->response->tools[0]->userLocation['region'])
        ->toBeNull();
    expect($current->response->tools[0]->userLocation['timezone'])
        ->toBeNull();
    expect($current->response->usage)
        ->toBeArray();
    expect($current->response->usage['input_tokens'])
        ->toBe(328);
    expect($current->response->usage['input_tokens_details']['cached_tokens'])
        ->toBe(0);
    expect($current->response->usage['output_tokens'])
        ->toBe(356);
    expect($current->response->usage['output_tokens_details']['reasoning_tokens'])
        ->toBe(0);
    expect($current->response->usage['total_tokens'])
        ->toBe(684);
    expect($current->response->user)
        ->toBeNull();
    expect($current->response->metadata)
        ->toBeArray();
    expect($current->response->metadata)
        ->toBeEmpty();
    expect($current->response->truncation)
        ->toBe('disabled');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
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
