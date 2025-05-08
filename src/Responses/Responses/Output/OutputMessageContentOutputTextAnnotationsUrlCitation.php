<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type UrlCitationType array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}
 *
 * @implements ResponseContract<UrlCitationType>
 */
final class OutputMessageContentOutputTextAnnotationsUrlCitation implements ResponseContract
{
    /**
     * @use ArrayAccessible<UrlCitationType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'url_citation'  $type
     */
    private function __construct(
        public readonly int $endIndex,
        public readonly int $startIndex,
        public readonly string $title,
        public readonly string $type,
        public readonly string $url,
    ) {}

    /**
     * @param  UrlCitationType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            endIndex: $attributes['end_index'],
            startIndex: $attributes['start_index'],
            title: $attributes['title'],
            type: $attributes['type'],
            url: $attributes['url'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'end_index' => $this->endIndex,
            'start_index' => $this->startIndex,
            'title' => $this->title,
            'type' => $this->type,
            'url' => $this->url,
        ];
    }
}
