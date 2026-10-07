<?php

declare(strict_types=1);

namespace OpenAI\Responses\Decisions;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type PredicateAnswerType from PredicateAnswer
 * @phpstan-import-type ChoiceAnswerType from ChoiceAnswer
 * @phpstan-import-type ScoreAnswerType from ScoreAnswer
 * @phpstan-import-type RefusalAnswerType from RefusalAnswer
 *
 * @phpstan-type CreateResponseType array{answers: array<int, PredicateAnswerType|ChoiceAnswerType|ScoreAnswerType|RefusalAnswerType>}
 *
 * @implements ResponseContract<CreateResponseType>
 */
final class CreateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<CreateResponseType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, PredicateAnswer|ChoiceAnswer|ScoreAnswer|RefusalAnswer>  $answers
     */
    private function __construct(
        public readonly array $answers,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  CreateResponseType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $answers = array_map(
            static fn (array $answer): PredicateAnswer|ChoiceAnswer|ScoreAnswer|RefusalAnswer => match ($answer['type']) {
                'predicate' => PredicateAnswer::from($answer),
                'choice' => ChoiceAnswer::from($answer),
                'score' => ScoreAnswer::from($answer),
                default => RefusalAnswer::from($answer),
            },
            $attributes['answers'],
        );

        return new self($answers, $meta);
    }

    /**
     * Returns the answer with the given question name, or null if none exists.
     */
    public function answer(string $name): PredicateAnswer|ChoiceAnswer|ScoreAnswer|RefusalAnswer|null
    {
        foreach ($this->answers as $answer) {
            if ($answer->name === $name) {
                return $answer;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'answers' => array_map(
                static fn (PredicateAnswer|ChoiceAnswer|ScoreAnswer|RefusalAnswer $answer): array => $answer->toArray(),
                $this->answers,
            ),
        ];
    }
}
