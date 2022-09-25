<?php

/**
 * @return array<string, mixed>
 */
function edit(): array
{
    return [
        'object' => 'edit',
        'created' => 1664135921,
        'choices' => [[
            'text' => "What day of the week is it?\n",
            'index' => 0,
        ]],
        'usage' => [
            'prompt_tokens' => 25,
            'completion_tokens' => 28,
            'total_tokens' => 53,
        ],

    ];
}
