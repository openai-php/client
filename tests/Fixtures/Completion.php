<?php

/**
 * @return array<string, mixed>
 */
function completion(): array
{
    return [
        'id' => 'cmpl-5uS6a68SwurhqAqLBpZtibIITICna',
        'object' => 'text_completion',
        'created' => 1664136088,
        'model' => 'text-davinci-002',
        'choices' => [
            [
                'text' => "el, she elaborates more on the Corruptor's role, suggesting K",
                'index' => 0,
                'logprobs' => null,
                'finish_reason' => 'length',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 1,
            'completion_tokens' => 16,
            'total_tokens' => 17,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function completionWithLogprobs(): array
{
    return [
        'id' => 'cmpl-65p5WsSeV4hDn3r5NjPxYSSbaZUgU',
        'object' => 'text_completion',
        'created' => 1666846042,
        'model' => 'code-davinci-002',
        'choices' => [
            0 => [
                'text' => 'PHP is',
                'index' => 0,
                'logprobs' => [
                    'tokens' => [
                        0 => 'PH',
                        1 => 'P',
                        2 => ' is',
                    ],
                    'token_logprobs' => [
                        0 => null,
                        1 => -1.3050697,
                        2 => -5.334749,
                    ],
                    'top_logprobs' => null,
                    'text_offset' => [
                        0 => 0,
                        1 => 2,
                        2 => 3,
                    ],
                ],
                'finish_reason' => 'length',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 3,
            'total_tokens' => 3,
        ],
    ];
}

function completionRequestMinimal(): array
{
    return [
        'model' => 'text-davinci-002',
    ];
}

function completionRequestMaximal(): array
{
    return [
        'model' => 'text-davinci-002',
        'prompt' => 'PHP is ',
        'suffix' => 'of all.',
        'max_tokens' => 100,
        'temperature' => 1.5,
        'top_p' => 0.5,
        'n' => 3,
        'stream' => false,
        'logprobs' => 5,
        'echo' => true,
        'stop' => [
            '\n',
            '<|endoftext|>',
        ],
        'presence_penalty' => -1.5,
        'frequency_penalty' => -0.5,
        'best_of' => 10,
        'logit_bias' => '{"50256":-100}',
        'user' => 'user-1234',
    ];
}
