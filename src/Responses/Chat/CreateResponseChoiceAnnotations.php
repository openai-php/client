<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceAnnotations
{
    /**
     * @param  ?array<int, CreateResponseChoiceAnnotationsUrlCitations>  $citations
     */
    public function __construct(
        public readonly ?array $citations,
    ) {}

    /**
     * @param array{type: 'url_citation', url_citation: array{start_index: int, end_index: int, title: string, url: string}} $attributes
     */
    public static function from(array $attributes): self
    {
        $annotations = [];

        if ($attributes['type'] === 'url_citation') {
            $annotations[] = CreateResponseChoiceAnnotationsUrlCitations::from($attributes['url_citation']);
        }

        return new self($annotations);
    }

    /**
     *  @return array{annotations: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>}
     */
    public function toArray(): array
    {
        return [
            'annotations' => array_map(
                fn(CreateResponseChoiceAnnotationsUrlCitations $citation): array => [
                    'type' => 'url_citation',
                    'url_citation' => $citation->toArray(),
                ],
                $this->citations
            ),
        ];
    }

}
