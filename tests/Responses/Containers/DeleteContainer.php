<?php

use OpenAI\Responses\Containers\DeleteContainer;

test('from', function () {
    $result = DeleteContainer::from(deleteContainerResource(), meta());

    expect($result)
        ->id->toBe('container_abc123')
        ->object->toBe('container')
        ->deleted->toBe(true);
});

test('to array', function () {
    $result = DeleteContainer::from(deleteContainerResource(), meta());

    expect($result->toArray())
        ->toBe([
            'id' => 'container_abc123',
            'object' => 'container',
            'deleted' => true,
        ]);
});
