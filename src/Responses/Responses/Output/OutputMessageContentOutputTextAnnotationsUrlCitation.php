<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

final class OutputMessageContentOutputTextAnnotationsUrlCitation
{
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
     * @param  array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['end_index'],
            $attributes['start_index'],
            $attributes['title'],
            $attributes['type'],
            $attributes['url'],
        );
    }

    /**
     * @return array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}
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
