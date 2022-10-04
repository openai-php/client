<?php

declare(strict_types=1);

namespace OpenAI\Responses\Edits;

use OpenAI\Contracts\Response;

final class CreateResponse implements Response
{
    /**
     * @param  array<int, CreateResponseChoice>  $choices
     */
    private function __construct(
        public readonly string $object,
        public readonly int $created,
        public readonly array $choices,
        public readonly CreateResponseUsage $usage,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, created: int, choices: array<int, array{text: string, index: int}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $choices = array_map(fn (array $result): CreateResponseChoice => CreateResponseChoice::from(
            $result
        ), $attributes['choices']);

        return new self(
            $attributes['object'],
            $attributes['created'],
            $choices,
            CreateResponseUsage::from($attributes['usage'])
        );
    }

    /**
     * @return  array{object: string, created: int, choices: array<int, array{text: string, index: int}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'created' => $this->created,
            'choices' => array_map(
                static fn (CreateResponseChoice $result): array => $result->toArray(),
                $this->choices,
            ),
            'usage' => $this->usage->toArray(),
        ];
    }
}
