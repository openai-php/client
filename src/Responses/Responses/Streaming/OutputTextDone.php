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
 * @phpstan-type OutputTextDoneType array{content_index: int, item_id: string, output_index: int, text: string}
 *
 * @implements ResponseContract<OutputTextDoneType>
 */
final class OutputTextDone implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<OutputTextDoneType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly int $contentIndex,
        public readonly string $itemId,
        public readonly int $outputIndex,
        public readonly string $text,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  OutputTextDoneType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            contentIndex: $attributes['content_index'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            text: $attributes['text'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'content_index' => $this->contentIndex,
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
            'text' => $this->text,
        ];
    }
}
