<?php

use OpenAI\Responses\Containers\Files\ContainerFileDeleteResponse;
use OpenAI\Responses\Meta\MetaInformation;

// from

test('from', function () {
    $result = ContainerFileDeleteResponse::from(containerFileDeleteResource(), meta());

    expect($result)
        ->id->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->object->toBe('container.file.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

// as array accessible

test('as array accessible', function () {
    $result = ContainerFileDeleteResponse::from(containerFileDeleteResource(), meta());

    expect($result['id'])
        ->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5');
});

// to array

test('to array', function () {
    $result = ContainerFileDeleteResponse::from(containerFileDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(containerFileDeleteResource());
});
