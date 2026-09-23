<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type WebSearchImageSettingsType array{max_results?: int, caption?: bool}
 *
 * @implements ResponseContract<WebSearchImageSettingsType>
 */
final class WebSearchImageSettings implements ResponseContract
{
    /**
     * @use ArrayAccessible<WebSearchImageSettingsType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly ?int $maxResults,
        public readonly ?bool $caption,
    ) {}

    /**
     * @param  WebSearchImageSettingsType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            maxResults: $attributes['max_results'] ?? null,
            caption: $attributes['caption'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = [];

        if ($this->maxResults !== null) {
            $data['max_results'] = $this->maxResults;
        }

        if ($this->caption !== null) {
            $data['caption'] = $this->caption;
        }

        return $data;
    }
}
