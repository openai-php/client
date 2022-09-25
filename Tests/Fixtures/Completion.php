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
        'model' => 'davinci',
        'choices' => [[
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
