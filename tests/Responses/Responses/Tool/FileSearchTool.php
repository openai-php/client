<?php

use OpenAI\Responses\Responses\Tool\FileSearchComparisonFilter;
use OpenAI\Responses\Responses\Tool\FileSearchCompoundFilter;
use OpenAI\Responses\Responses\Tool\FileSearchRankingOption;
use OpenAI\Responses\Responses\Tool\FileSearchTool;

test('from', function () {
    $response = FileSearchTool::from(toolFileSearch());

    expect($response)
        ->toBeInstanceOf(FileSearchTool::class)
        ->type->toBe('file_search')
        ->vectorStoreIds->toBe(['vector_store_id_1', 'vector_store_id_2'])
        ->filters->toBeInstanceOf(FileSearchComparisonFilter::class)
        ->filters->key->toBe('search-term')
        ->filters->type->toBe('eq')
        ->filters->value->toBe('search-term-value')
        ->maxNumResults->toBe(5)
        ->rankingOptions->toBeInstanceOf(FileSearchRankingOption::class)
        ->rankingOptions->ranker->toBe('bm25')
        ->rankingOptions->scoreThreshold->toBe(0.5);
});

test('from null filters', function () {
    $payload = toolFileSearch();
    $payload['filters'] = null;
    $response = FileSearchTool::from($payload);

    expect($response)
        ->toBeInstanceOf(FileSearchTool::class)
        ->filters->toBeNull();
});

test('from complex nested filters', function () {
    $response = FileSearchTool::from(toolFileSearchNestedFilters());

    expect($response)
        ->toBeInstanceOf(FileSearchTool::class)
        ->filters->toBeInstanceOf(FileSearchCompoundFilter::class)
        ->filters->filters->toBeArray()
        ->and($response->filters->filters[0])
        ->toBeInstanceOf(FileSearchCompoundFilter::class)
        ->filters->toBeArray()
        ->and($response->filters->filters[0]->filters[0])
        ->toBeInstanceOf(FileSearchComparisonFilter::class)
        ->and($response->filters->filters[0]->filters[1])
        ->toBeInstanceOf(FileSearchComparisonFilter::class);
});

test('from results', function () {
    $response = FileSearchTool::from(toolFileSearch());

    expect($response)
        ->toBeInstanceOf(FileSearchTool::class)
        ->type->toBe('file_search');
});

test('as array accessible', function () {
    $response = FileSearchTool::from(toolFileSearch());

    expect($response['type'])->toBe('file_search');
});

test('to array', function () {
    $response = FileSearchTool::from(toolFileSearch());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolFileSearch());
});
