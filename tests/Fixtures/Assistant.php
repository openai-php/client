<?php

/**
 * @return array<string, mixed>
 */
function assistantResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant',
        'created_at' => 1699619403,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor.',
        'tools' => [
            0 => [
                'type' => 'code_interpreter',
            ],
        ],
        'file_ids' => [],
        'metadata' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            assistantResource(),
            assistantResource(),
        ],
        'first_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'last_id' => 'asst_y49lAdZDiaQUxEBR6zrG846Q',
        'has_more' => true,
    ];
}

/**
 * @return array<string, mixed>
 */
function assistantDeleteResource(): array
{
    return [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant.deleted',
        'deleted' => true,
    ];
}
