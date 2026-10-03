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
 * @phpstan-type ShellCallCommandDeltaType array{type: string, command_index: int, output_index: int, sequence_number: int, delta: string, obfuscation?: string}
 *
 * @implements ResponseContract<ShellCallCommandDeltaType>
 */
final class ShellCallCommandDelta implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ShellCallCommandDeltaType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly int $commandIndex,
        public readonly int $outputIndex,
        public readonly int $sequenceNumber,
        public readonly string $delta,
        public readonly ?string $obfuscation,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ShellCallCommandDeltaType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            commandIndex: $attributes['command_index'],
            outputIndex: $attributes['output_index'],
            sequenceNumber: $attributes['sequence_number'],
            delta: $attributes['delta'],
            obfuscation: $attributes['obfuscation'] ?? null,
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'command_index' => $this->commandIndex,
            'output_index' => $this->outputIndex,
            'sequence_number' => $this->sequenceNumber,
            'delta' => $this->delta,
            'obfuscation' => $this->obfuscation,
        ], fn (mixed $value): bool => $value !== null);
    }
}
