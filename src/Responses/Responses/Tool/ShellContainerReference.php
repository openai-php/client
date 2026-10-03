<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ShellContainerReferenceType array{type: 'container_reference', container_id: string}
 *
 * @implements ResponseContract<ShellContainerReferenceType>
 */
final class ShellContainerReference implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellContainerReferenceType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'container_reference'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $containerId,
    ) {}

    /**
     * @param  ShellContainerReferenceType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            containerId: $attributes['container_id'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'container_id' => $this->containerId,
        ];
    }
}
