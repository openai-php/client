<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceWebSearchOptionsUserLocation
{
    public function __construct(
        public readonly array $approximate
    ) {}

    /**
     * @param array{approximate: array{country: string, region: string, city: string}} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['approximate']
        );
    }

    /**
     * @return array{type: string, approximate: array{country: string, region: string, city: string}}
     */
    public function toArray(): array
    {
        return [
            'type' => 'approximate',
            'approximate' => $this->approximate,
        ];
    }
}
