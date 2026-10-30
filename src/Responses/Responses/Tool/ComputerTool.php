<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ComputerToolType array{type: 'computer'}
 *
 * @implements ResponseContract<ComputerToolType>
 */
final class ComputerTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<ComputerToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'computer'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  ComputerToolType  $attributes
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
