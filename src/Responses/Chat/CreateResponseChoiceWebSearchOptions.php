<?php

namespace OpenAI\Responses\Chat;
final class CreateResponseChoiceWebSearchOptions
{

    /**
     * @param string $searchContextSize
     * @param CreateResponseChoiceWebSearchOptionsUserLocation|null $userLocation
     */
    public function __construct(
        public readonly string $searchContextSize,
        public readonly ?CreateResponseChoiceWebSearchOptionsUserLocation $userLocation,
    ) {}

    /**
     * @param array{search_context_size?: string, user_location?: array{approximate: array{type: string}}} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['search_context_size'] ?? 'medium',
            isset($attributes['user_location']) ? CreateResponseChoiceWebSearchOptionsUserLocation::from($attributes['user_location']) : null,
        );
    }

    /**
     * @return array{search_context_size: string, user_location?: array{approximate: array{type: string}}
     */
    public function toArray(): array
    {
        return [
            'search_context_size' => $this->searchContextSize,
            'user_location' => $this->userLocation?->toArray(),
        ];
    }
}
