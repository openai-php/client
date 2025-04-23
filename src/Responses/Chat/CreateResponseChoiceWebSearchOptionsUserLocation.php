<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceWebSearchOptionsUserLocation
{
    public function __construct(
        public readonly array $approximate
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['approximate']
        );
    }

    public function toArray(): array
    {
        return [
            'approximate' => $this->approximate,
        ];
    }
}
