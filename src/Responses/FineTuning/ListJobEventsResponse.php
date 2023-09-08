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
 * @implements ResponseContract<array{object: string, data: array<int, array{object: string, id: string, created_at: int, level: string, message: string, data: array{step: int, train_loss: float, train_mean_token_accuracy: float}|null, type: string}>, has_more: bool}>
 */
final class ListJobEventsResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{object: string, id: string, created_at: int, level: string, message: string, data: array{step: int, train_loss: float, train_mean_token_accuracy: float}|null, type: string}>, has_more: bool}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, ListJobEventsResponseEvent>  $data
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
     * @param  array{object: string, data: array<int, array{object: string, id: string, created_at: int, level: string, message: string, data: array{step: int, train_loss: float, train_mean_token_accuracy: float}|null, type: string}>, has_more: bool}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $data = array_map(fn (array $result): ListJobEventsResponseEvent => ListJobEventsResponseEvent::from(
            $result
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
                static fn (ListJobEventsResponseEvent $response): array => $response->toArray(),
                $this->data,
            ),
            'has_more' => $this->hasMore,
        ];
    }
}
