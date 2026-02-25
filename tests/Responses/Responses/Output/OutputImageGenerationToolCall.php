<?php

use OpenAI\Responses\Responses\Output\OutputImageGenerationToolCall;

test('from', function () {
    $response = OutputImageGenerationToolCall::from(outputImageGenerationToolCall());

    expect($response)
        ->toBeInstanceOf(OutputImageGenerationToolCall::class)
        ->id->toBe('ig_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->result->toBe('iVBORw0KGgoAAAAN...')
        ->status->toBe('completed')
        ->type->toBe('image_generation_call')
        ->action->toBe('generate')
        ->background->toBe('opaque')
        ->outputFormat->toBe('webp')
        ->quality->toBe('high')
        ->revisedPrompt->toBe('This is a revised prompt.')
        ->size->toBe('1536x1024');
});

test('as array accessible', function () {
    $response = OutputImageGenerationToolCall::from(outputImageGenerationToolCall());

    expect($response['id'])->toBe('ig_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->and($response['result'])->toBe('iVBORw0KGgoAAAAN...')
        ->and($response['status'])->toBe('completed')
        ->and($response['type'])->toBe('image_generation_call')
        ->and($response['action'])->toBe('generate')
        ->and($response['background'])->toBe('opaque')
        ->and($response['output_format'])->toBe('webp')
        ->and($response['quality'])->toBe('high')
        ->and($response['revised_prompt'])->toBe('This is a revised prompt.')
        ->and($response['size'])->toBe('1536x1024');
});

test('to array', function () {
    $response = OutputImageGenerationToolCall::from(outputImageGenerationToolCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputImageGenerationToolCall());
});
