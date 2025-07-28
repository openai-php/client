<?php

/**
 * @return array<string, mixed>
 */
function embedding(): array
{
    return [
        'object' => 'embedding',
        'index' => 0,
        'embedding' => [
            -0.008906792,
            -0.013743395,
            0.009874112,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function embeddingWithoutIndex(): array
{
    return [
        'object' => 'embedding',
        'embedding' => [
            -0.008906792,
            -0.013743395,
            0.009874112,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function embeddingList(): array
{
    return [
        'object' => 'list',
        'model' => 'text-embedding-3-small',
        'data' => [
            embedding(),
            embedding(),
        ],
        'usage' => [
            'prompt_tokens' => 8,
            'total_tokens' => 8,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function embeddingListWithoutUsage(): array
{
    return [
        'object' => 'list',
        'model' => 'text-embedding-3-small',
        'data' => [
            embedding(),
            embedding(),
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function embeddingListWithoutModel(): array
{
    return [
        'object' => 'list',
        'data' => [
            embedding(),
            embedding(),
        ],
        'usage' => [
            'prompt_tokens' => 8,
            'total_tokens' => 8,
        ],
    ];
}
