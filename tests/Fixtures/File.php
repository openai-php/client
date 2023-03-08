<?php

/**
 * @return array<string, mixed>
 */
function fileResource(): array
{
    return [
        'id' => 'file-XjGxS3KTG0uNmNOK362iJua3',
        'object' => 'file',
        'bytes' => 140,
        'created_at' => 1613779121,
        'filename' => 'mydata.jsonl',
        'purpose' => 'fine-tune',
        'status' => 'succeeded',
        'status_details' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function fileWithErrorStatusResource(): array
{
    return [
        'id' => 'file-OGHjVIyNB7svNc6vaUXNgR87',
        'object' => 'file',
        'bytes' => 181023,
        'created_at' => 1678253244,
        'filename' => 'mydata_corrupt.jsonl',
        'purpose' => 'fine-tune',
        'status' => 'error',
        'status_details' => "Invalid file format. Example 1273 cannot be parsed. Error: line contains invalid json: Expecting ',' delimiter: line 1 column 79 (char 78) (line 1273)",
    ];
}

/**
 * @return array<string, mixed>
 */
function fileListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            fileResource(),
            fileResource(),
        ],
    ];
}

function fileContentResource(): string
{
    return file_get_contents(__DIR__.'/MyFile.jsonl');
}

/**
 * @return resource
 */
function fileResourceResource()
{
    return fopen(__DIR__.'/MyFile.jsonl', 'r');
}

/**
 * @return array<string, mixed>
 */
function fileDeleteResource(): array
{
    return [
        'id' => 'file-XjGxS3KTG0uNmNOK362iJua3',
        'object' => 'file',
        'deleted' => true,
    ];
}
