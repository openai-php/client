<?php

use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\ResponseObject;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('delete', function () {
    $client = mockClient('DELETE', 'responses/asst_SMzoVX8XmCZEg1EbMHoAm8tc', [], Response::from(deleteResponseResource(), metaHeaders()));

    $result = $client->responses()->delete('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    expect($result)
        ->toBeInstanceOf(DeleteResponse::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('response.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'responses/asst_SMzoVX8XmCZEg1EbMHoAm8tc/input_items', [], Response::from(listInputItemsResource(), metaHeaders()));

    $result = $client->responses()->list('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    expect($result)
        ->toBeInstanceOf(ListInputItems::class)
        ->object->toBe('list')
        ->data->toBeArray()
        ->firstId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->lastId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'responses/asst_SMzoVX8XmCZEg1EbMHoAm8tc', [], Response::from(retrieveResponseResource(), metaHeaders()));

    $result = $client->responses()->retrieve('asst_SMzoVX8XmCZEg1EbMHoAm8tc');

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('response')
        ->createdAt->toBe(1699619403)
        ->status->toBe('completed');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create', function () {
    $client = mockClient('POST', 'responses', [
        'model' => 'gpt-4o-mini',
        'tools' => [
            [
                'type' => 'web_search_preview'
            ]
        ],
        'input' => "what was a positive news story from today?"
        ], Response::from(createResponseResource(), metaHeaders()));

    $result = $client->responses()->create([
        'model' => 'gpt-4o-mini',
        'tools' => [
            [
                'type' => 'web_search_preview'
            ]
        ],
        'input' => "what was a positive news story from today?"
        ]);

    expect($result)
        ->toBeInstanceOf(ResponseObject::class)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('response')
        ->createdAt->toBe(1699619403)
        ->status->toBe('completed')
        ->output->toBeArray()
        ->output->toHaveCount(1)
        ->outout[0]->type->toBe('message')
        ->output[0]->toBeInstanceOf(ResponseObject::class)
        ->output[0]->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->output[0]->status->toBe('completed')
        ->output[0]->role->toBe('assistant')
        ->output[0]->content->toBeArray()
        ->output[0]->content[0]->toBeInstanceOf(ResponseObject::class)
        ->output[0]->content[0]->type->toBe('output_text')
        ->output[0]->content[0]->text->toBe('The image depicts a scenic landscape with a wooden boardwalk or pathway leading through lush, green grass under a blue sky with some clouds. The setting suggests a peaceful natural area, possibly a park or nature reserve. There are trees and shrubs in the background.')
        ->output[0]->content[0]->annotations->toBeArray()
        ->output[0]->content[0]->annotations->toHaveCount(0)
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
        ->tools->toHaveCount(0)
        ->topP->toBe(1.0)
        ->truncation->toBe('disabled')
        ->usage->toBeArray()
        ->usage['input_tokens']->toBe(328)
        ->usage['input_tokens_details']['cached_tokens']->toBe(0)
        ->usage['output_tokens']->toBe(52)
        ->usage['output_tokens_details']['reasoning_tokens']->toBe(0)
        ->usage['total_tokens']->toBe(380)
        ->user->toBeNull()
        ->metadata->toBeArray()
        ->metadata->toBeEmpty();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('createStreamed', function () {
    $client = mockClient('POST', 'responses', [
        'stream' => true,
        'model' => 'gpt-4o-mini',
        'tools' => [
            [
                'type' => 'web_search_preview'
            ]
        ],
        'input' => "what was a positive news story from today?"
        ], Response::from(createStreamedResponseResource(), metaHeaders()));

        $result = $client->responses()->createStreamed([
        'model' => 'gpt-4o-mini',
        'tools' => [
            [
                'type' => 'web_search_preview'
            ]
        ],
        'input' => "what was a positive news story from today?"
        ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    expect($result->getIterator()->current())
      ->toBeInstanceOf(CreateStreamedResponse::class)
      ->event->toBe('response.created')
      ->response->toBeInstanceOf(CreateResponse::class)
      ->response->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
      ->response->object->toBe('response')
      ->response->createdAt->toBe(1699619403)
      ->response->status->toBe('completed')
      ->response->output->toBeArray()
      ->response->output->toHaveCount(1)
      ->response->output[0]->type->toBe('message')
      ->response->output[0]->toBeInstanceOf(ResponseObject::class)
      ->response->output[0]->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
      ->response->output[0]->status->toBe('completed')
      ->response->output[0]->role->toBe('assistant')
      ->response->output[0]->content->toBeArray()
      ->response->output[0]->content[0]->toBeInstanceOf(ResponseObject::class)
      ->response->output[0]->content[0]->type->toBe('output_text')
      ->response->output[0]->content[0]->text->toBe('The image depicts a scenic landscape with a wooden boardwalk or pathway leading through lush, green grass under a blue sky with some clouds. The setting suggests a peaceful natural area, possibly a park or nature reserve. There are trees and shrubs in the background.')
      ->response->output[0]->content[0]->annotations->toBeArray()
      ->response->output[0]->content[0]->annotations->toHaveCount(0)
      ->response->parallelToolCalls->toBeTrue()
      ->response->previousResponseId->toBeNull()
      ->response->reasoning->toBeArray()
      ->response->reasoning['effort']->toBeNull()
      ->response->reasoning['generate_summary']->toBeNull()
      ->response->store->toBeTrue()
      ->response->temperature->toBe(1.0)
      ->response->text->toBeArray()
      ->response->text['format']['type']->toBe('text')
      ->response->toolChoice->toBe('auto')
      ->response->tools->toBeArray()
      ->response->tools->toHaveCount(0)
      ->response->topP->toBe(1.0)
      ->response->truncation->toBe('disabled')
      ->response->usage->toBeArray()
      ->response->usage['input_tokens']->toBe(328)
      ->response->usage['input_tokens_details']['cached_tokens']->toBe(0)
      ->response->usage['output_tokens']->toBe(52)
      ->response->usage['output_tokens_details']['reasoning_tokens']->toBe(0)
      ->response->usage['total_tokens']->toBe(380)
      ->response->user->toBeNull()
      ->response->metadata->toBeArray()
      ->response->metadata->toBeEmpty();

    expect($result->meta())
            ->toBeInstanceOf(MetaInformation::class);
});
