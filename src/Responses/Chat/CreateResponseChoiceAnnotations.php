<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceAnnotations
{
    /**
     * @param  ?array<int, CreateResponseChoiceAnnotationsUrlCitations>  $annotations
     */
    public function __construct(
        public readonly ?array $annotations,
    ) {}

    /**
     * @param  array{type: 'url_citation', url_citation: array{ end_index: int, start_index: int, title: string, url: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $annotations = [];

        if(isset($attributes['url_citation'])) {
            $annotations = array_map(fn (array $result) : CreateResponseChoiceAnnotations => CreateResponseChoiceAnnotations::from(
                $result
            ), $attributes['url_citation']);
        }
        dump($annotations);
        return new self($annotations);
        }


    /**
     * @return array{annotations: array<int, array{type: string, url_citation: array{end_index: int, start_index: int, title: string, url: string}}>}
     */
    public function toArray(): array
    {
        return array_map(
            fn (CreateResponseChoiceAnnotationsUrlCitations $citation): array => [
                'type' => 'url_citation',
                'url_citation' => $citation->toArray(),
            ],
            $this->annotations ?? null
        );
    }
}
