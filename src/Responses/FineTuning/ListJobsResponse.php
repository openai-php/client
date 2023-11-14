<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTuning;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{object: string, data: array<int, array{id: string, object: string, model: string, created_at: int, finished_at: ?int, fine_tuned_model: ?string, hyperparameters: array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}, organization_id: string, result_files: array<int, string>, status: string, validation_file: ?string, training_file: string, trained_tokens: ?int, error: ?array{code: string, param: ?string, message: string}}>, has_more: bool}>
 */
final class ListJobsResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{id: string, object: string, model: string, created_at: int, finished_at: ?int, fine_tuned_model: ?string, hyperparameters: array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}, organization_id: string, result_files: array<int, string>, status: string, validation_file: ?string, training_file: string, trained_tokens: ?int, error: ?array{code: string, param: ?string, message: string}}>, has_more: bool}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, RetrieveJobResponse>  $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly bool $hasMore,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, data: array<int, array{id: string, object: string, model: string, created_at: int, finished_at: ?int, fine_tuned_model: ?string, hyperparameters: array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}, organization_id: string, result_files: array<int, string>, status: string, validation_file: ?string, training_file: string, trained_tokens: ?int, error: ?array{code: string, param: ?string, message: string}}>, has_more: bool}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $data = array_map(fn (array $result): RetrieveJobResponse => RetrieveJobResponse::from(
            $result,
            $meta,
        ), $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
            $attributes['has_more'],
            $meta,
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
                static fn (RetrieveJobResponse $response): array => $response->toArray(),
                $this->data,
            ),
            'has_more' => $this->hasMore,
        ];
    }
}
