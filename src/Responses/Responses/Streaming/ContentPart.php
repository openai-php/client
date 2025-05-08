<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputText;
use OpenAI\Responses\Responses\Output\OutputMessageContentRefusal;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputTextType from OutputMessageContentOutputText
 * @phpstan-import-type ContentRefusalType from OutputMessageContentRefusal
 *
 * @phpstan-type ContentPartType array{content_index: int, item_id: string, output_index: int, part: OutputTextType|ContentRefusalType}
 *
 * @implements ResponseContract<ContentPartType>
 */
final class ContentPart implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ContentPartType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly int $contentIndex,
        public readonly string $itemId,
        public readonly int $outputIndex,
        public readonly OutputMessageContentOutputText|OutputMessageContentRefusal $part,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ContentPartType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $part = match ($attributes['part']['type']) {
            'output_text' => OutputMessageContentOutputText::from($attributes['part']),
            'refusal' => OutputMessageContentRefusal::from($attributes['part']),
        };

        return new self(
            contentIndex: $attributes['content_index'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            part: $part,
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
            'part' => $this->part->toArray(),
        ];
    }
}
