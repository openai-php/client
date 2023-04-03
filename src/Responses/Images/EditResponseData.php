<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{url: string}|array{b64_json: string}>
 */
final class EditResponseData implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{url: string}|array{b64_json: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $url = '',
        public readonly string $b64_json = '',
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
            $attributes['url'] ?? '',
            $attributes['b64_json'] ?? '',
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->url !== '' && $this->url !== '0' ?
            ['url' => $this->url] :
            ['b64_json' => $this->b64_json];
    }
}
