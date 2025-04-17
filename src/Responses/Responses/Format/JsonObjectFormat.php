<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Format;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'json_object'}>
 */
final class JsonObjectFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'json_object'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'json_object'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  array{type: 'json_object'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
