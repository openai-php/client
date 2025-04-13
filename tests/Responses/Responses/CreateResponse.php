<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponse;

test('from', function () {
    $response = CreateResponse::from(createResponseResource(), meta());

    expect($response)
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
        ->output->toHaveCount(2)
        ->output[0]->type->toBe('web_search_call')
        ->output[0]->id->toBe('ws_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->output[0]->status->toBe('completed')
        ->output[1]->type->toBe('message')
        ->output[1]->id->toBe('msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c')
        ->output[1]->status->toBe('completed')
        ->output[1]->role->toBe('assistant')
        ->output[1]->content->toBeArray()
        ->output[1]->content->toHaveCount(1)
        ->output[1]->content[0]->type->toBe('output_text')
        ->output[1]->content[0]->text->toBe('As of today, March 9, 2025, one notable positive news story...')
        ->output[1]->content[0]->annotations->toBeArray()
        ->output[1]->content[0]->annotations->toHaveCount(3)
        ->output[1]->content[0]->annotations[0]->type->toBe('url_citation')
        ->output[1]->content[0]->annotations[0]->startIndex->toBe(442)
        ->output[1]->content[0]->annotations[0]->endIndex->toBe(557)
        ->output[1]->content[0]->annotations[0]->url->toBe('https://.../?utm_source=chatgpt.com')
        ->output[1]->content[0]->annotations[0]->title->toBe('...')
        ->output[1]->content[0]->annotations[1]->type->toBe('url_citation')
        ->output[1]->content[0]->annotations[1]->startIndex->toBe(962)
        ->output[1]->content[0]->annotations[1]->endIndex->toBe(1077)
        ->output[1]->content[0]->annotations[1]->url->toBe('https://.../?utm_source=chatgpt.com')
        ->output[1]->content[0]->annotations[1]->title->toBe('...')
        ->output[1]->content[0]->annotations[2]->type->toBe('url_citation')
        ->output[1]->content[0]->annotations[2]->startIndex->toBe(1336)
        ->output[1]->content[0]->annotations[2]->endIndex->toBe(1451)
        ->output[1]->content[0]->annotations[2]->url->toBe('https://.../?utm_source=chatgpt.com')
        ->output[1]->content[0]->annotations[2]->title->toBe('...')
        ->parallelToolCalls->toBeTrue()
        ->previousResponseId->toBeNull()
        ->reasoning->toBeArray()
        ->reasoning['effort']->toBeNull()
        ->reasoning['generate_summary']->toBeNull()
        ->store->toBeTrue()
        ->temperature->toBe(1.0)
        ->text->toBeArray()
        ->text['format']['type']->toBe('text')
        ->toolChoice->toBe('auto')
        ->tools->toBeArray()
        ->tools->toHaveCount(1)
        ->tools[0]->type->toBe('web_search_preview')
        ->tools[0]->domains->toBeArray()->toBeEmpty()
        ->tools[0]->searchContextSize->toBe('medium')
        ->tools[0]->userLocation->toBeArray()
        ->tools[0]->userLocation['type']->toBe('approximate')
        ->tools[0]->userLocation['city']->toBeNull()
        ->tools[0]->userLocation['country']->toBe('US')
        ->tools[0]->userLocation['region']->toBeNull()
        ->tools[0]->userLocation['timezone']->toBeNull()
        ->topP->toBe(1.0)
        ->truncation->toBe('disabled')
        ->usage->toBeArray()
        ->usage->toHaveCount(1)
        ->usage['input_tokens']->toBe(328)
        ->usage['input_tokens_details']['cached_tokens']->toBe(0)
        ->usage['output_tokens']->toBe(356)
        ->usage['output_tokens_details']['reasoning_tokens']->toBe(0)
        ->usage['total_tokens']->toBe(684)
        ->user->toBeNull()
        ->metadata->toBe([]);

    expect($response->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $response = CreateResponse::from(createResponseResource(), meta());

    expect($response['id'])->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('to array', function () {
    $response = CreateResponse::from(createResponseResource(), meta());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(createResponseResource());
});

test('fake', function () {
    $response = CreateResponse::fake();

    expect($response)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('fake with override', function () {
    $response = CreateResponse::fake([
        'id' => 'resp_1234',
        'object' => 'custom_response',
        'status' => 'failed',
    ]);

    expect($response)
        ->id->toBe('resp_1234')
        ->object->toBe('custom_response')
        ->status->toBe('failed');
});
