<?php

use OpenAI\Enums\Moderation\Category;
use OpenAI\Factories\DataObjects\Moderation\ModerationCategoryFactory;

test('build new moderation category', function () {
    $category = ModerationCategoryFactory::new([
        'category' => Category::Hate->value,
        'violated' => true,
        'score' => 0.1234,
    ]);

    expect($category)
        ->category->toBe(Category::Hate)
        ->violated->toBe(true)
        ->score->toBe(0.1234);
});

test('create array from moderation category', function () {
    $raw = [
        'category' => Category::Hate->value,
        'violated' => true,
        'score' => 0.1234,
    ];

    $category = ModerationCategoryFactory::new($raw);

    expect($category->toArray())
        ->toBeArray()
        ->toBe($raw);
});
