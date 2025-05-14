<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type DoubleClickType array{type: 'double_click', x: float, y: float}
 *
 * @implements ResponseContract<DoubleClickType>
 */
final class OutputComputerActionDoubleClick implements ResponseContract
{
    /**
     * @use ArrayAccessible<DoubleClickType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'double_click'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly float $x,
        public readonly float $y,
    ) {}

    /**
     * @param  DoubleClickType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            x: $attributes['x'],
            y: $attributes['y'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}
