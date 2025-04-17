<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'double_click', x: float, y: float}>
 */
final class OutputComputerActionDoubleClick implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'double_click', x: float, y: float}>
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
     * @param  array{type: 'double_click', x: float, y: float}  $attributes
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
