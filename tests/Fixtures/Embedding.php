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
function embeddingList(): array
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
