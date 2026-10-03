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
 * @phpstan-type ShellCallOutputContentDeltaType array{type: string, command_index: int, output_index: int, sequence_number: int, item_id: string, delta: array{stdout?: string, stderr?: string}}
 *
 * @implements ResponseContract<ShellCallOutputContentDeltaType>
 */
final class ShellCallOutputContentDelta implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ShellCallOutputContentDeltaType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array{stdout?: string, stderr?: string}  $delta
     */
    private function __construct(
        public readonly string $type,
        public readonly int $commandIndex,
        public readonly int $outputIndex,
        public readonly int $sequenceNumber,
        public readonly string $itemId,
        public readonly array $delta,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ShellCallOutputContentDeltaType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            commandIndex: $attributes['command_index'],
            outputIndex: $attributes['output_index'],
            sequenceNumber: $attributes['sequence_number'],
            itemId: $attributes['item_id'],
            delta: $attributes['delta'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'command_index' => $this->commandIndex,
            'output_index' => $this->outputIndex,
            'sequence_number' => $this->sequenceNumber,
            'item_id' => $this->itemId,
            'delta' => $this->delta,
        ];
    }
}
