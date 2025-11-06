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
 * @phpstan-type CodeInterpreterCallType array{type: string, item_id: string, output_index: int}
 *
 * @implements ResponseContract<CodeInterpreterCallType>
 */
final class CodeInterpreterCall implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<CodeInterpreterCallType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly string $itemId,
        public readonly int $outputIndex,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  CodeInterpreterCallType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
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
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
        ];
    }
}
