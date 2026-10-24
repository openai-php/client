<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Environments\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type DesktopType array{enabled: bool}
 *
 * @implements ResponseContract<DesktopType>
 */
final class Desktop implements ResponseContract
{
    /**
     * @use ArrayAccessible<DesktopType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly bool $enabled,
    ) {}

    /**
     * @param  DesktopType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            enabled: $attributes['enabled'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled,
        ];
    }
}
