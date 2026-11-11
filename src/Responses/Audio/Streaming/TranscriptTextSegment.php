<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type TranscriptTextSegmentType array{id: string, start: float, end: float, text: string, speaker: string}
 *
 * @implements ResponseContract<TranscriptTextSegmentType>
 */
final class TranscriptTextSegment implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<TranscriptTextSegmentType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $id,
        public readonly float $start,
        public readonly float $end,
        public readonly string $text,
        public readonly string $speaker,
        public readonly MetaInformation $meta,
    ) {}

    /**
     * @param  TranscriptTextSegmentType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            start: $attributes['start'],
            end: $attributes['end'],
            text: $attributes['text'],
            speaker: $attributes['speaker'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'text' => $this->text,
            'speaker' => $this->speaker,
        ];
    }
}
