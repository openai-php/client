<?php

use OpenAI\Responses\Containers\Files\ContainerFileResponse;

test('from', function () {
    $result = ContainerFileResponse::from(containerFileResource(), meta());

    expect($result)
        ->id->toBe('cfile_682e0e8a43c88191a7978f477a09bdf5')
        ->object->toBe('container.file')
        ->createdAt->toBe(1747848842)
        ->bytes->toBe(880)
        ->containerId->toBe('cntr_682e0e7318108198aa783fd921ff305e08e78805b9fdbb04')
        ->path->toBe('/mnt/data/88e12fa445d32636f190a0b33daed6cb-tsconfig.json')
        ->source->toBe('user');
});

test('from response with null bytes', function () {
    $result = ContainerFileResponse::from(containerFileResourceAssistant(), meta());

    expect($result)
        ->id->toBe('cfile_68efad3233308191ae2aea6fdc172940')
        ->object->toBe('container.file')
        ->createdAt->toBe(1760537906)
        ->bytes->toBeNull()
        ->containerId->toBe('cntr_68efad24888881938f8d8a661b5036450ac07bb92e293373')
        ->path->toBe('/mnt/data/dummy_risk_priority_bar_chart.png')
        ->source->toBe('assistant');
});

test('as array accessible', function () {
    $result = ContainerFileResponse::from(containerFileResource(), meta());

    expect($result['container_id'])
        ->toBe('cntr_682e0e7318108198aa783fd921ff305e08e78805b9fdbb04');
});

test('to array', function () {
    $result = ContainerFileResponse::from(containerFileResource(), meta());

    expect($result->toArray())
        ->toBe(containerFileResource());
});
