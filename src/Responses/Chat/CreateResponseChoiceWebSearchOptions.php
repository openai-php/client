<?php

namespace OpenAI\Responses\Chat;
class CreateResponseChoiceWebSearchOptions
{
    //calls CreateResponseChoiceWebSearchOptionsContent

    /**
     * @param CreateResponseChoiceWebSearchOptionsContent $content
     */
    private function __construct(
        public readonly CreateResponseChoiceWebSearchOptionsContent $content,
    )
    {
    }

    /**
     * @param array{search_context_size?: string, user_location?: array{approximate: array{type: string}}} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            CreateResponseChoiceWebSearchOptionsContent::from($attributes)
        );
    }

    /**
     * @return array{search_context_size: string, user_location?: array{approximate: array{type: string}}
     */
    public function toArray(): array
    {
        return $this->content->toArray();
    }
}
