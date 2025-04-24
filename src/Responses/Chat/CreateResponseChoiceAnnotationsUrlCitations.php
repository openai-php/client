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
     * @param array{start_index: int, end_index: int, title: string, url: string} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['start_index'],
            $attributes['end_index'],
            $attributes['title'],
            $attributes['url'],
        );
    }

    /**
     * @return array{start_index: int, end_index: int, title: string, url: string}
     */
    public function toArray(): array
    {
        return [
            'start_index' => $this->startIndex,
            'end_index' => $this->endIndex,
            'title' => $this->title,
            'url' => $this->url,
        ];
    }
}


