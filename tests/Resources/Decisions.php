<?php

use OpenAI\Responses\Decisions\ChoiceAnswer;
use OpenAI\Responses\Decisions\CreateResponse;
use OpenAI\Responses\Decisions\PredicateAnswer;
use OpenAI\Responses\Decisions\RefusalAnswer;
use OpenAI\Responses\Decisions\ScoreAnswer;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $params = [
        'model' => 'gpt-6-luna',
        'input' => 'Please refund my order.',
        'questions' => [
            ['type' => 'predicate', 'name' => 'is_spam', 'instructions' => 'The text is spam.'],
        ],
    ];

    $client = mockClient('POST', 'decisions', $params, Response::from(decisionResource(), metaHeaders()));

    $result = $client->decisions()->create($params);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->answers->toHaveCount(4);

    expect($result->answers[0])
        ->toBeInstanceOf(PredicateAnswer::class)
        ->name->toBe('is_spam')
        ->probability->toBe(0.97);

    expect($result->answers[1])
        ->toBeInstanceOf(ChoiceAnswer::class)
        ->choice->toBe('negative')
        ->confidence->toBe(0.85)
        ->probabilities->toHaveCount(3);

    expect($result->answers[2])
        ->toBeInstanceOf(ScoreAnswer::class)
        ->score->toBe(2.5)
        ->probabilities->toHaveCount(3);

    expect($result->answers[2]->probabilities[0]->value)->toBe(1);
    expect($result->answers[2]->probabilities[0]->label)->toBe('low');

    expect($result->answers[3])
        ->toBeInstanceOf(RefusalAnswer::class)
        ->name->toBe('unsafe_question');

    expect($result->answer('sentiment'))->toBe($result->answers[1])
        ->and($result->answer('missing'))->toBeNull();

    expect($result->toArray())->toBe(decisionResource());

    expect($result->meta())->toBeInstanceOf(MetaInformation::class);
});

test('create with unnamed questions and boolean choices', function () {
    $params = [
        'model' => 'gpt-6-luna',
        'input' => 'Please refund my order.',
        'questions' => [
            ['type' => 'predicate', 'instructions' => 'The customer asks for a refund.'],
            ['type' => 'choice', 'instructions' => 'The text is spam.', 'choices' => [['value' => true], ['value' => false]]],
            ['type' => 'score', 'instructions' => 'Rate how urgent the request is.', 'levels' => [['label' => 'low'], ['label' => 'high']]],
            ['type' => 'predicate', 'instructions' => 'The customer is a minor.'],
        ],
    ];

    $attributes = [
        'answers' => [
            ['type' => 'predicate', 'name' => null, 'probability' => 0.98],
            [
                'type' => 'choice',
                'name' => null,
                'choice' => false,
                'probabilities' => [
                    ['value' => true, 'probability' => 0.1],
                    ['value' => false, 'probability' => 0.9],
                ],
                'confidence' => 0.9,
            ],
            [
                'type' => 'score',
                'name' => null,
                'score' => 0.2,
                'probabilities' => [
                    ['value' => 0, 'label' => 'low', 'probability' => 0.8],
                    ['value' => 1, 'label' => 'high', 'probability' => 0.2],
                ],
                'confidence' => 0.8,
            ],
            ['type' => 'refusal', 'name' => null],
        ],
    ];

    $client = mockClient('POST', 'decisions', $params, Response::from($attributes, metaHeaders()));

    $result = $client->decisions()->create($params);

    expect($result->answers[0])
        ->toBeInstanceOf(PredicateAnswer::class)
        ->name->toBeNull();

    expect($result->answers[1])
        ->toBeInstanceOf(ChoiceAnswer::class)
        ->name->toBeNull()
        ->choice->toBeFalse();

    expect($result->answers[1]->probabilities[0]->value)->toBeTrue();

    expect($result->answers[2])
        ->toBeInstanceOf(ScoreAnswer::class)
        ->name->toBeNull();

    expect($result->answers[3])
        ->toBeInstanceOf(RefusalAnswer::class)
        ->name->toBeNull();

    expect($result->toArray())->toBe($attributes);
});
