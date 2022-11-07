<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}>
 */
final class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, CreateResponseData>  $data
     */
    private function __construct(
        public readonly int $created,
        public readonly array $data,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{created: int, data: array<int, array{url?: string, b64_json?: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $results = array_map(fn (array $result): CreateResponseData => CreateResponseData::from(
            $result
        ), $attributes['data']);

        return new self(
            $attributes['created'],
            $results,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'created' => $this->created,
            'data' => array_map(
                static fn (CreateResponseData $result): array => $result->toArray(),
                $this->data,
            ),
        ];
    }
}
