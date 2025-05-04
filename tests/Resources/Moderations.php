<?php

use OpenAI\Enums\Moderations\Category;
use OpenAI\Enums\Moderations\CategoryAppliedInputType;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Responses\Moderations\CreateResponseCategory;
use OpenAI\Responses\Moderations\CreateResponseResult;
use OpenAI\ValueObjects\Transporter\Response;

dataset('create omni inputs', [
    'text_in_array' => [
        ['type' => 'text', 'text' => 'I love to kill...'],
    ],
    'basic_text' => 'I want to kill them.',
]);

test('create legacy', closure: function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ], Response::from(moderationResource(), metaHeaders()));

    $result = $client->moderations()->create([
        'model' => 'text-moderation-latest',
        'input' => 'I want to kill them.',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('text-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseResult::class);

    expect($result->results[0])
        ->flagged->toBeTrue()
        ->categories->toHaveCount(11)
        ->each->toBeInstanceOf(CreateResponseCategory::class);

    expect($result->results[0]->categories[Category::Hate->value])
        ->category->toBe(Category::Hate)
        ->violated->toBe(false)
        ->score->toBe(0.22714105248451233);

    expect($result->results[0]->categories[Category::Violence->value])
        ->category->toBe(Category::Violence)
        ->violated->toBe(true)
        ->score->toBe(0.9223177433013916);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create omni', closure: function ($input) {
    $client = mockClient('POST', 'moderations', [
        'model' => 'omni-moderation-latest',
        'input' => $input,
    ], Response::from(moderationOmniResource(), metaHeaders()));

    $result = $client->moderations()->create([
        'model' => 'omni-moderation-latest',
        'input' => $input,
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('omni-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseResult::class);

    expect($result->results[0])
        ->flagged->toBeTrue()
        ->categories->toHaveCount(13)
        ->each->toBeInstanceOf(CreateResponseCategory::class);

    expect($result->results[0]->categories[Category::Illicit->value])
        ->category->toBe(Category::Illicit)
        ->violated->toBe(false)
        ->score->toBe(0.1602763684674149);

    expect($result->results[0]->categories[Category::IllicitViolent->value])
        ->category->toBe(Category::IllicitViolent)
        ->violated->toBe(true)
        ->score->toBe(0.9223177433013916);

    expect($result->results[0]->categoryAppliedInputTypes)
        ->toHaveCount(13)
        ->each->toBe([CategoryAppliedInputType::Text->value]);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
})->with('create omni inputs');

test('create omni with image and text', closure: function () {
    $client = mockClient('POST', 'moderations', [
        'model' => 'omni-moderation-latest',
        'input' => [
            ['type' => 'text', 'text' => '.. I want to kill...'],
            [
                'type' => 'image_url',
                'image_url' => [
                    'url' => 'https://example.com/image.png',
                ],
            ],
        ],
    ], Response::from(moderationOmniWithTextAndImageResource(), metaHeaders()));

    $result = $client->moderations()->create([
        'model' => 'omni-moderation-latest',
        'input' => [
            ['type' => 'text', 'text' => '.. I want to kill...'],
            [
                'type' => 'image_url',
                'image_url' => [
                    'url' => 'https://example.com/image.png',
                ],
            ],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('modr-5MWoLO')
        ->model->toBe('omni-moderation-001')
        ->results->toBeArray()->toHaveCount(1)
        ->results->each->toBeInstanceOf(CreateResponseResult::class);

    expect($result->results[0])
        ->flagged->toBeTrue()
        ->categories->toHaveCount(13)
        ->each->toBeInstanceOf(CreateResponseCategory::class)
        ->categoryAppliedInputTypes->toHaveCount(13);

    expect($result->results[0]->categories[Category::ViolenceGraphic->value])
        ->category->toBe(Category::ViolenceGraphic)
        ->violated->toBe(true)
        ->score->toBe(5.7929166992142E-5);

    expect($result->results[0]->categoryAppliedInputTypes[Category::IllicitViolent->value])
        ->toBe([CategoryAppliedInputType::Text->value]);

    expect($result->results[0]->categoryAppliedInputTypes[Category::ViolenceGraphic->value])
        ->toBe([CategoryAppliedInputType::Text->value, CategoryAppliedInputType::Image->value]);

});
