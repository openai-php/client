<?php

declare(strict_types=1);

namespace OpenAI\Responses\Moderations;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, model: string, results: array<int, array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}>}>
 */
final class CreateResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, model: string, results: array<int, array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, CreateResponseResult>  $results
     */
    private function __construct(
        public readonly string $id,
        public readonly string $model,
        public readonly array $results,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, model: string, results: array<int, array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $results = array_map(fn (array $result): CreateResponseResult => CreateResponseResult::from(
            $result
        ), $attributes['results']);

        return new self(
            $attributes['id'],
            $attributes['model'],
            $results,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'results' => array_map(
                static fn (CreateResponseResult $result): array => $result->toArray(),
                $this->results,
            ),
        ];
    }
}
