<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{refusal: string, type: 'refusal'}>
 */
final class OutputMessageContentRefusal implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{refusal: string, type: 'refusal'}>
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
     * @param  array{refusal: string, type: 'refusal'}  $attributes
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
