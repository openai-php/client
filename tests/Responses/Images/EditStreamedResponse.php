<?php

use OpenAI\Responses\Images\EditStreamedResponse;

test('fake', function () {
    $response = EditStreamedResponse::fake();

    expect($response->getIterator()->current())
        ->toBeInstanceOf(EditStreamedResponse::class)
        ->event->toBe('image_edit.partial_image');
});
