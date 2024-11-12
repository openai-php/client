<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Messages;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{url: string, detail?: string}>
 */
final class ThreadMessageResponseContentImageUrl implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{url: string, detail?: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $url,
        public ?string $detail,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{url: string, detail?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['url'],
            $attributes['detail'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'url' => $this->url,
            'detail' => $this->detail,
        ], fn (?string $value): bool => $value !== null);
    }
}
