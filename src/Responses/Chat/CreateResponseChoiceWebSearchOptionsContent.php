<?php

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceWebSearchOptionsContent
{
    public function __construct(
        public readonly string $searchContextSize = 'medium',
        public readonly ?CreateResponseChoiceWebSearchOptionsUserLocation $userLocation = null
    ) {}

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['search_context_size'] ?? 'medium',
            isset($attributes['user_location']) ? CreateResponseChoiceWebSearchOptionsUserLocation::from($attributes['user_location']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'search_context_size' => $this->searchContextSize,
            'user_location' => $this->userLocation?->toArray(),
        ];
    }
}


