<?php

use OpenAI\Responses\Containers\Files\ContainerFileListResponse;
use OpenAI\Responses\Containers\Files\ContainerFileResponse;

// from

test('from', function () {
    $result = ContainerFileListResponse::from(containerFileListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(1)
        ->data->{0}->toBeInstanceOf(ContainerFileResponse::class)
        ->firstId->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->lastId->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->hasMore->toBe(false);
});

// as array accessible

test('as array accessible', function () {
    $result = ContainerFileListResponse::from(containerFileListResource(), meta());

    expect($result['first_id'])
        ->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5');
});

// to array

test('to array', function () {
    $result = ContainerFileListResponse::from(containerFileListResource(), meta());

    expect($result->toArray())
        ->toBe(containerFileListResource());
});
