<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceAnnotationsUrlCitations
{
    public function __construct(
        public readonly int $endIndex,
        public readonly int $startIndex,
        public readonly string $title,
        public readonly string $url,
    ) {}

    /**
     * @param  array{end_index: int, start_index: int, title: string, url: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['end_index'],
            $attributes['start_index'],
            $attributes['title'],
            $attributes['url'],
        );
    }

    /**
     * @return array{end_index: int, start_index: int, title: string, url: string}
     */
    public function toArray(): array
    {
        return [
            'end_index' => $this->endIndex,
            'start_index' => $this->startIndex,
            'title' => $this->title,
            'url' => $this->url,
        ];
    }
}
