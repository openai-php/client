<?php

use OpenAI\Responses\Containers\Files\ContainerFileDeleteResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = ContainerFileDeleteResponse::from(containerFileDeleteResource(), meta());

    expect($result)
        ->id->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->object->toBe('container.file.deleted')
        ->deleted->toBeTrue()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ContainerFileDeleteResponse::from(containerFileDeleteResource(), meta());

    expect($result['id'])
        ->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5');
});

test('to array', function () {
    $result = ContainerFileDeleteResponse::from(containerFileDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(containerFileDeleteResource());
});
