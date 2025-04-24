<?php

namespace OpenAI\Responses\Chat;
final class CreateResponseChoiceAnnotations
{

    /**
     * @param ?array<int, CreateResponseChoiceAnnotationsUrlCitations>  $urlCitations
     */
    public function __construct(
        public readonly ?array $urlCitations,
    ) {
    }

    /**
     * @param array{url_citation: array{start_index: int, end_index: int, title: string, url: string}} $attributes
     */
    public static function from(array $attributes): self
    {
        $urlCitations = null;
        if (isset($attributes['url_citation']) && is_array($attributes['url_citation'])) {
            $urlCitations = array_map(
                fn (array $result): CreateResponseChoiceAnnotationsUrlCitations => CreateResponseChoiceAnnotationsUrlCitations::from($result),
                $attributes['url_citation']
            );
        }
        return new self($urlCitations);
    }

    /**
     * @return array{url_citation: array{start_index: int, end_index: int, title: string, url: string}}
     */
    public function toArray(): array
    {
        return [
            'type' => 'url_citation',
            'url_citation' => $this->urlCitations ? array_map(
                static fn (CreateResponseChoiceAnnotationsUrlCitations $result): array => $result->toArray(),
                $this->urlCitations,
            ): null,
        ];
    }
}
