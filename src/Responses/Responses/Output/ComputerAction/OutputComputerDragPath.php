<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{x: int, y: int}>
 */
final class OutputComputerDragPath implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{x: int, y: int}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $x,
        public readonly int $y,
    ) {}

    /**
     * @param  array{x: int, y: int}  $attributes
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
