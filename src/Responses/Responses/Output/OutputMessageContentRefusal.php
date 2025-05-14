<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ContentRefusalType array{refusal: string, type: 'refusal'}
 *
 * @implements ResponseContract<ContentRefusalType>
 */
final class OutputMessageContentRefusal implements ResponseContract
{
    /**
     * @use ArrayAccessible<ContentRefusalType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'refusal'  $type
     */
    private function __construct(
        public readonly string $refusal,
        public readonly string $type,
    ) {}

    /**
     * @param  ContentRefusalType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            refusal: $attributes['refusal'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'refusal' => $this->refusal,
            'type' => $this->type,
        ];
    }
}
