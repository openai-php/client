<?php

/**
 * @return array<string, mixed>
 */
function containerFileResource(): array
{
    return [
        'id' => 'cfile_682e0e8a43c88191a7978f477a09bdf5',
        'object' => 'container.file',
        'created_at' => 1747848842,
        'bytes' => 880,
        'container_id' => 'cntr_682e0e7318108198aa783fd921ff305e08e78805b9fdbb04',
        'path' => '/mnt/data/88e12fa445d32636f190a0b33daed6cb-tsconfig.json',
        'source' => 'user',
    ];
}

/**
 * @return array<string, mixed>
 */
function containerFileListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            containerFileResource(),
        ],
        'first_id' => 'cfile_682e0e8a43c88191a7978f477a09bdf5',
        'last_id' => 'cfile_682e0e8a43c88191a7978f477a09bdf5',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function containerFileDeleteResource(): array
{
    return [
        'id' => 'cfile_682e0e8a43c88191a7978f477a09bdf5',
        'object' => 'container.file.deleted',
        'deleted' => true,
    ];
}
