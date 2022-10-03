<?php

use OpenAI\Enums\Moderation\Category;
use OpenAI\Factories\Responses\Moderations\CreateResponseModerationCategoryFactory;

test('build new create response moderation category', function () {
    $category = CreateResponseModerationCategoryFactory::new([
        'category' => Category::Hate->value,
        'violated' => true,
        'score' => 0.1234,
    ]);

    expect($category)
        ->category->toBe(Category::Hate)
        ->violated->toBe(true)
        ->score->toBe(0.1234);
});
