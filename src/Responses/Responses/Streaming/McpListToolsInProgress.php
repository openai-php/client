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
 * @phpstan-type McpListToolsType array{sequence_number: int, output_index: int, item_id: string}
 *
 * @implements ResponseContract<McpListToolsType>
 */
final class McpListToolsInProgress implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<McpListToolsType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly int $sequenceNumber,
        public readonly int $outputIndex,
        public readonly string $itemId,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  McpListToolsType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            sequenceNumber: $attributes['sequence_number'],
            outputIndex: $attributes['output_index'],
            itemId: $attributes['item_id'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'sequence_number' => $this->sequenceNumber,
            'output_index' => $this->outputIndex,
            'item_id' => $this->itemId,
        ];
    }
}
