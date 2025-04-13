<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @implements ResponseContract<array{id?: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}|array{role?: string, content: null, function_call: array{name?: string, arguments?: string}}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
 */
final class CreateStreamedResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}|array{role?: string, content: null, function_call: array{name?: string, arguments?: string}}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    /**
     * @param  array<int, CreateStreamedResponseChoice>  $choices
     */
    private function __construct(
        public readonly ?string $id,
        public readonly string $object,
        public readonly int $created,
        public readonly string $model,
        public readonly array $choices,
        public readonly ?CreateResponseUsage $usage,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id?: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $choices = array_map(fn (array $result): CreateStreamedResponseChoice => CreateStreamedResponseChoice::from(
            $result
        ), $attributes['choices']);

        return new self(
            $attributes['id'] ?? null,
            $attributes['object'],
            $attributes['created'],
            $attributes['model'],
            $choices,
            isset($attributes['usage']) ? CreateResponseUsage::from($attributes['usage']) : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'model' => $this->model,
            'choices' => array_map(
                static fn (CreateStreamedResponseChoice $result): array => $result->toArray(),
                $this->choices,
            ),
            'usage' => $this->usage?->toArray(),
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
