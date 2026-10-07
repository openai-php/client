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
