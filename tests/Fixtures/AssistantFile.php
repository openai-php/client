<?php

/**
 * @return array<string, mixed>
 */
function assistantFileResource(): array
{
    return [
        'id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
        'object' => 'assistant.file',
        'created_at' => 1699620898,
        'assistant_id' => 'asst_y49lAdZDiaQUxEBR6zrG846Q',
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantFileListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            assistantFileResource(),
            assistantFileResource(),
        ],
        'first_id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
        'last_id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantFileDeleteResource(): array
{
    return [
        'id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
        'object' => 'assistant.file.deleted',
        'deleted' => true,
    ];
}
