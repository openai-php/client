<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{url?: string, b64_json?: string}>
 */
final class VariationResponseData implements Response
{
    /**
     * @use ArrayAccessible<array{url?: string, b64_json?: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly ?string $url = null,
        public readonly ?string $b64_json = null,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{url?: string, b64_json?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['url'] ?? null,
            $attributes['b64_json'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'url' => $this->url,
            'b64_json' => $this->b64_json,
        ], fn ($value): bool => $value !== null);
    }
}
