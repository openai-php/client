<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Messages;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'image_url', image_url: array{url: string, detail?: string}}>
 */
final class ThreadMessageResponseContentImageUrlObject implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'image_url', image_url: array{url: string, detail?: string}}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'image_url'  $type
     */
    private function __construct(
        public string $type,
        public ThreadMessageResponseContentImageUrl $imageFile,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: 'image_url', image_url: array{url: string, detail?: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            ThreadMessageResponseContentImageUrl::from($attributes['image_url']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'image_url' => $this->imageFile->toArray(),
        ];
    }
}
