<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputWebSearchToolCallTextResultType array{type: 'text_result', title?: string, url?: string, snippet?: string}
 *
 * @implements ResponseContract<OutputWebSearchToolCallTextResultType>
 */
final class OutputWebSearchToolCallTextResult implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputWebSearchToolCallTextResultType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'text_result'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $title,
        public readonly ?string $url,
        public readonly ?string $snippet,
    ) {}

    /**
     * @param  OutputWebSearchToolCallTextResultType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            title: $attributes['title'] ?? null,
            url: $attributes['url'] ?? null,
            snippet: $attributes['snippet'] ?? null,
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

        if ($this->title !== null) {
            $data['title'] = $this->title;
        }

        if ($this->url !== null) {
            $data['url'] = $this->url;
        }

        if ($this->snippet !== null) {
            $data['snippet'] = $this->snippet;
        }

        return $data;
    }
}
