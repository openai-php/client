<?php

/**
 * @return array<string, mixed>
 */
function imageCreateWithUrl(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageCreateWithUrlDallE3(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
                'revised_prompt' => 'This is a revised prompt.',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageCreateWithB46Json(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'b64_json' => 'iVBORw0KGgoAAAAN...',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageEditWithUrl(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageEditWithB46Json(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'b64_json' => 'iVBORw0KGgoAAAAN...',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageVariationWithUrl(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageVariationWithB46Json(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'b64_json' => 'iVBORw0KGgoAAAAN...',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageCreateWithUsage(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
            ],
        ],
        'usage' => [
            'total_tokens' => 100,
            'input_tokens' => 50,
            'output_tokens' => 50,
            'input_tokens_details' => [
                'text_tokens' => 10,
                'image_tokens' => 40,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageEditWithUsage(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
            ],
        ],
        'usage' => [
            'total_tokens' => 100,
            'input_tokens' => 50,
            'output_tokens' => 50,
            'input_tokens_details' => [
                'text_tokens' => 10,
                'image_tokens' => 40,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageVariationWithUsage(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
            ],
        ],
        'usage' => [
            'total_tokens' => 100,
            'input_tokens' => 50,
            'output_tokens' => 50,
            'input_tokens_details' => [
                'text_tokens' => 10,
                'image_tokens' => 40,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function imageCreateWithRevisedPrompt(): array
{
    return [
        'created' => 1664136088,
        'data' => [
            [
                'url' => 'https://openai.com/image.png',
                'revised_prompt' => 'A cute baby sea otter with a pearl earring',
            ],
        ],
    ];
}
