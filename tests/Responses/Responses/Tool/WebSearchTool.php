<?php

use OpenAI\Responses\Responses\Tool\WebSearchImageSettings;
use OpenAI\Responses\Responses\Tool\WebSearchTool;
use OpenAI\Responses\Responses\Tool\WebSearchUserLocation;

test('from', function () {
    $response = WebSearchTool::from(toolWebSearchPreview());

    expect($response)
        ->toBeInstanceOf(WebSearchTool::class)
        ->type->toBe('web_search_preview')
        ->searchContextSize->toBe('medium')
        ->userLocation->toBeInstanceOf(WebSearchUserLocation::class)
        ->searchContentTypes->toBe(['image', 'text'])
        ->imageSettings->toBeInstanceOf(WebSearchImageSettings::class)
        ->imageSettings->maxResults->toBe(3)
        ->imageSettings->caption->toBeTrue();
});

test('from without image search settings', function () {
    $payload = toolWebSearchPreview();
    unset($payload['search_content_types'], $payload['image_settings']);

    $response = WebSearchTool::from($payload);

    expect($response)
        ->toBeInstanceOf(WebSearchTool::class)
        ->searchContentTypes->toBeNull()
        ->imageSettings->toBeNull();

    expect($response->toArray())
        ->toBe($payload)
        ->not->toHaveKeys(['search_content_types', 'image_settings']);
});

test('to array', function () {
    $response = WebSearchTool::from(toolWebSearchPreview());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolWebSearchPreview());
});
