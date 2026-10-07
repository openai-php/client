<?php

namespace OpenAI\Testing\Responses\Fixtures\Decisions;

final class CreateResponseFixture
{
    public const ATTRIBUTES = [
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
    ];
}
