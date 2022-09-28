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
    ];
}

/**
 * @return string
 */
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
