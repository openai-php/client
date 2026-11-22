<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputTextType array{type: string, content_index: int, delta: string, item_id: string, output_index: int, sequence_number: int, logprobs?: array<int, array{token: string, logprob: float, top_logprobs?: array<int, array{token: string, logprob: float}>}>}
 *
 * @implements ResponseContract<OutputTextType>
 */
final class OutputTextDelta implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<OutputTextType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, array{token: string, logprob: float, top_logprobs?: array<int, array{token: string, logprob: float}>}>|null  $logprobs
     */
    private function __construct(
        public readonly string $type,
        public readonly int $contentIndex,
        public readonly string $delta,
        public readonly string $itemId,
        public readonly int $outputIndex,
        public readonly int $sequenceNumber,
        public readonly ?array $logprobs,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  OutputTextType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            contentIndex: $attributes['content_index'],
            delta: $attributes['delta'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            sequenceNumber: $attributes['sequence_number'],
            logprobs: $attributes['logprobs'] ?? null,
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $attributes = [
            'type' => $this->type,
            'content_index' => $this->contentIndex,
            'delta' => $this->delta,
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
            'sequence_number' => $this->sequenceNumber,
        ];

        if ($this->logprobs !== null) {
            $attributes['logprobs'] = $this->logprobs;
        }

        return $attributes;
    }
}
