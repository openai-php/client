<?php

use OpenAI\Responses\Responses\Tool\ImageGenerationInputImageMask;
use OpenAI\Responses\Responses\Tool\ImageGenerationTool;

test('from', function () {
    $response = ImageGenerationTool::from(toolImageGeneration());

    expect($response)
        ->toBeInstanceOf(ImageGenerationTool::class)
        ->type->toBe('image_generation')
        ->background->toBe('transparent')
        ->inputImageMask->toBeNull()
        ->model->toBe('gpt-image-1')
        ->moderation->toBe('auto')
        ->outputCompression->toBe(100)
        ->outputFormat->toBe('png')
        ->partialImages->toBe(0)
        ->quality->toBe('auto')
        ->size->toBe('auto');
});

test('from non-null input_image_mask', function () {
    $payload = toolImageGeneration();
    $payload['input_image_mask'] = [
        'image_url' => 'https://example.com/mask.png',
        'file_id' => 'file_1234567890abcdef',
    ];
    $response = ImageGenerationTool::from($payload);

    expect($response)
        ->toBeInstanceOf(ImageGenerationTool::class)
        ->inputImageMask->toBeInstanceOf(ImageGenerationInputImageMask::class);
});

test('from results', function () {
    $response = ImageGenerationTool::from(toolImageGeneration());

    expect($response)
        ->toBeInstanceOf(ImageGenerationTool::class)
        ->type->toBe('image_generation');
});

test('as array accessible', function () {
    $response = ImageGenerationTool::from(toolImageGeneration());

    expect($response['type'])->toBe('image_generation');
});

test('to array', function () {
    $response = ImageGenerationTool::from(toolImageGeneration());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolImageGeneration());
});
