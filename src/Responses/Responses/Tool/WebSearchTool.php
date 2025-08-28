<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type UserLocationType from WebSearchUserLocation
 *
 * @phpstan-type WebSearchToolType array{type: 'web_search'|'web_search_preview'|'web_search_preview_2025_03_11', search_context_size: 'low'|'medium'|'high', user_location: ?UserLocationType}
 *
 * @implements ResponseContract<WebSearchToolType>
 */
final class WebSearchTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<WebSearchToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'web_search'|'web_search_preview'|'web_search_preview_2025_03_11'  $type
     * @param  'low'|'medium'|'high'  $searchContextSize
     */
    private function __construct(
        public readonly string $type,
        public readonly string $searchContextSize,
        public readonly ?WebSearchUserLocation $userLocation,
    ) {}

    /**
     * @param  WebSearchToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            searchContextSize: $attributes['search_context_size'],
            userLocation: isset($attributes['user_location'])
                ? WebSearchUserLocation::from($attributes['user_location'])
                : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'search_context_size' => $this->searchContextSize,
            'user_location' => $this->userLocation?->toArray(),
        ];
    }
}
