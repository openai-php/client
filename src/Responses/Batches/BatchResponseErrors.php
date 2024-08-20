<?php

declare(strict_types=1);

namespace OpenAI\Responses\Batches;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}>
 */
final class BatchResponseErrors implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}>
     */
    use ArrayAccessible;

    /**
     * @param  array<array-key, BatchResponseErrorsData>  $data
     */
    private function __construct(
        public string $object,
        public array $data,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, data: array<array-key, array{code: string, message: string, param: ?string, line: ?int}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['object'],
            array_map(
                fn (array $data): \OpenAI\Responses\Batches\BatchResponseErrorsData => BatchResponseErrorsData::from($data),
                $attributes['data']
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(fn (BatchResponseErrorsData $data): array => $data->toArray(), $this->data),
        ];
    }
}
