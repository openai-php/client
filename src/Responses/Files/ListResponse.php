<?php

declare(strict_types=1);

namespace OpenAI\Responses\Files;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|null}>}>
 */
final class ListResponse implements Response
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|null}>}>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, RetrieveResponse>  $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|null}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $data = array_map(fn (array $result): RetrieveResponse => RetrieveResponse::from(
            $result
        ), $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(
                static fn (RetrieveResponse $response): array => $response->toArray(),
                $this->data,
            ),
        ];
    }
}
