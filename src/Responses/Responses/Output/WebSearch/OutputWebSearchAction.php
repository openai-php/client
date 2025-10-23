<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\WebSearch;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type WebSearchActionSourcesType from OutputWebSearchActionSources
 *
 * @phpstan-type WebSearchActionType array{type: 'search', query?: string, sources?: array<int, WebSearchActionSourcesType>}
 *
 * @implements ResponseContract<WebSearchActionType>
 */
final class OutputWebSearchAction implements ResponseContract
{
    /**
     * @use ArrayAccessible<WebSearchActionType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'search'  $type
     * @param  array<int, OutputWebSearchActionSources>  $sources
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $query,
        public readonly ?array $sources,
    ) {}

    /**
     * @param  WebSearchActionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            query: $attributes['query'] ?? null,
            sources: isset($attributes['sources'])
                ? array_map(
                    static fn (array $source): OutputWebSearchActionSources => OutputWebSearchActionSources::from($source),
                    $attributes['sources'],
                )
                : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
        ];

        if ($this->sources !== null) {
            $data['sources'] = array_map(
                static fn (OutputWebSearchActionSources $source): array => $source->toArray(),
                $this->sources,
            );
        }

        if ($this->query !== null) {
            $data['query'] = $this->query;
        }

        return $data;
    }
}
