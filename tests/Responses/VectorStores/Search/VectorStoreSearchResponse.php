<?php

use OpenAI\Responses\VectorStores\Search\VectorStoreSearchResponse;
use OpenAI\Responses\VectorStores\Search\VectorStoreSearchResponseFile;

test('from', function () {
    $result = VectorStoreSearchResponse::from(vectorStoreSearchResource(), meta());

    expect($result)
        ->object->toBe('vector_store.search_results.page')
        ->searchQuery->toBe('What is the return policy?')
        ->data->toBeArray()->toHaveCount(2)
        ->data->{0}->toBeInstanceOf(VectorStoreSearchResponseFile::class)
        ->hasMore->toBe(false)
        ->nextPage->toBe(null);
});

test('as array accessible', function () {
    $result = VectorStoreSearchResponse::from(vectorStoreSearchResource(), meta());

    expect($result['search_query'])
        ->toBe('What is the return policy?');
});

test('to array', function () {
    $result = VectorStoreSearchResponse::from(vectorStoreSearchResource(), meta());

    expect($result->toArray())
        ->toBe(vectorStoreSearchResource());
});

test('fake', function () {
    $response = VectorStoreSearchResponse::fake();

    expect($response)
        ->object->toBe('vector_store.search_results.page')
        ->searchQuery->toBe('What is the return policy?')
        ->hasMore->toBe(false)
        ->nextPage->toBe(null);
});

test('fake with override', function () {
    $response = VectorStoreSearchResponse::fake([
        'object' => 'custom_object',
        'search_query' => 'Custom query',
        'has_more' => false,
        'next_page' => null,
    ]);

    expect($response)
        ->object->toBe('custom_object')
        ->searchQuery->toBe('Custom query')
        ->hasMore->toBe(false)
        ->nextPage->toBeNull();
});
