<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceAnnotations
{
    public function __construct(
        public readonly string $type,
        public readonly CreateResponseChoiceAnnotationsUrlCitations $urlCitations
    ) {}

    /**
     * @param  array{type: string, url_citation: array{end_index: int, start_index: int, title: string, url: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            CreateResponseChoiceAnnotationsUrlCitations::from($attributes['url_citation'])
        );
    }

    /**
     * @return array{type: string, url_citation: array{end_index: int, start_index: int, title: string, url: string}}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'url_citation' => $this->urlCitations->toArray(),
        ];
    }
}
