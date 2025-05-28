<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type DragPathType array{x: int, y: int}
 *
 * @implements ResponseContract<DragPathType>
 */
final class OutputComputerDragPath implements ResponseContract
{
    /**
     * @use ArrayAccessible<DragPathType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $x,
        public readonly int $y,
    ) {}

    /**
     * @param  DragPathType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
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
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}
