<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\WebSearch;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type WebSearchActionSourcesType array{type: 'url', url: string}
 *
 * @implements ResponseContract<WebSearchActionSourcesType>
 */
final class OutputWebSearchActionSources implements ResponseContract
{
    /**
     * @use ArrayAccessible<WebSearchActionSourcesType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'url'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $url
    ) {}

    /**
     * @param  WebSearchActionSourcesType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            url: $attributes['url'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'url' => $this->url,
        ];
    }
}
