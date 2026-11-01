<?php

namespace OpenAI\Testing\Responses\Fixtures\Decisions;

final class CreateResponseFixture
{
    public const ATTRIBUTES = [
        'model' => 'gpt-6-luna',
        'answers' => [
            [
                'type' => 'predicate',
                'name' => 'is_spam',
                'probability' => 0.97,
            ],
            [
                'type' => 'choice',
                'name' => 'sentiment',
                'choice' => 'negative',
                'probabilities' => [
                    ['value' => 'positive', 'probability' => 0.05],
                    ['value' => 'negative', 'probability' => 0.85],
                    ['value' => 'neutral', 'probability' => 0.1],
                ],
                'confidence' => 0.85,
            ],
            [
                'type' => 'score',
                'name' => 'urgency',
                'score' => 2.5,
                'probabilities' => [
                    ['value' => 1, 'label' => 'low', 'probability' => 0.2],
                    ['value' => 2, 'label' => 'medium', 'probability' => 0.5],
                    ['value' => 3, 'label' => 'high', 'probability' => 0.3],
                ],
                'confidence' => 0.5,
            ],
            [
                'type' => 'refusal',
                'name' => 'unsafe_question',
            ],
        ],
        'usage' => [
            'input_tokens' => 154,
            'input_tokens_details' => [
                'cached_tokens' => 0,
                'cache_write_tokens' => 0,
            ],
            'output_tokens' => 0,
            'output_tokens_details' => [
                'reasoning_tokens' => 0,
            ],
            'total_tokens' => 154,
        ],
    ];
}
