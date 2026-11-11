<?php

use OpenAI\Responses\Images\CreateStreamedResponse;

test('fake', function () {
    $response = CreateStreamedResponse::fake();

    expect($response->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->event->toBe('image_generation.partial_image');
});
