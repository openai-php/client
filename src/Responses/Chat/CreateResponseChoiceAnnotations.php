<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceAnnotations
{
    /**
     * @param array<int, CreateResponseChoiceAnnotationsUrlCitations> $urlCitations
     */
    public function __construct(
        public readonly array $urlCitations
    ) {}

    /**
     * @param array<int, array{type: 'url_citation', url_citation: array{end_index: int, start_index: int, title: string, url: string}}> $attributes
     */
    public static function from(array $attributes): self
    {
        $urlCitations = array_map(
            fn(array $citation) => CreateResponseChoiceAnnotationsUrlCitations::from($citation['url_citation']),
            array_filter($attributes, fn(array $annotation) => $annotation['type'] === 'url_citation')
        );

        return new self($urlCitations);
    }

    /**
     * @return array<int, array{type: string, url_citation: array{end_index: int, start_index: int, title: string, url: string}}>
     */
public function toArray(): array
{
    return array_map(
        fn(CreateResponseChoiceAnnotationsUrlCitations $citation) => [
            'type' => 'url_citation',
            'url_citation' => $citation->toArray(),
        ],
        $this->urlCitations
    );
}
}
