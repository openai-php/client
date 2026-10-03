<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputShellCallOutputContent;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputShellCallOutputContentType from OutputShellCallOutputContent
 *
 * @phpstan-type ShellCallOutputContentDoneType array{type: string, command_index: int, output_index: int, sequence_number: int, item_id: string, output: array<int, OutputShellCallOutputContentType>}
 *
 * @implements ResponseContract<ShellCallOutputContentDoneType>
 */
final class ShellCallOutputContentDone implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ShellCallOutputContentDoneType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, OutputShellCallOutputContent>  $output
     */
    private function __construct(
        public readonly string $type,
        public readonly int $commandIndex,
        public readonly int $outputIndex,
        public readonly int $sequenceNumber,
        public readonly string $itemId,
        public readonly array $output,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ShellCallOutputContentDoneType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            commandIndex: $attributes['command_index'],
            outputIndex: $attributes['output_index'],
            sequenceNumber: $attributes['sequence_number'],
            itemId: $attributes['item_id'],
            output: array_map(fn (array $output): OutputShellCallOutputContent => OutputShellCallOutputContent::from($output), $attributes['output']),
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
            'output' => array_map(fn (OutputShellCallOutputContent $output): array => $output->toArray(), $this->output),
        ];
    }
}
