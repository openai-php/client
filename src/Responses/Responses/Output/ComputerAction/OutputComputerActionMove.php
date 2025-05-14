<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type MoveType array{type: 'move', x: int, y: int}
 *
 * @implements ResponseContract<MoveType>
 */
final class OutputComputerActionMove implements ResponseContract
{
    /**
     * @use ArrayAccessible<MoveType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'move'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly int $x,
        public readonly int $y,
    ) {}

    /**
     * @param  MoveType  $attributes
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
