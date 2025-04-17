<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: float, y: float}>
 */
final class OutputComputerActionClick implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: float, y: float}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'left'|'right'|'wheel'|'back'|'forward'  $button
     * @param  'click'  $type
     */
    private function __construct(
        public readonly string $button,
        public readonly string $type,
        public readonly float $x,
        public readonly float $y,
    ) {}

    /**
     * @param  array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: float, y: float}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            button: $attributes['button'],
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
            'button' => $this->button,
            'type' => $this->type,
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}
