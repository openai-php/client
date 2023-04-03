<?php

namespace OpenAI\Testing\Responses\Fixtures\Embeddings;

final class CreateResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'object' => 'embedding',
                'index' => 0,
                'embedding' => [
                    -0.008906792,
                    -0.013743395,
                ],
            ],
        ],
        'usage' => [
            'prompt_tokens' => 8,
            'total_tokens' => 8,
        ],
    ];
}
