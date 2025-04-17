<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}>
 */
final class OutputComputerActionScroll implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'scroll'  $type
     */
    private function __construct(
        public readonly int $scrollX,
        public readonly int $scrollY,
        public readonly string $type,
        public readonly int $x,
        public readonly int $y,
    ) {}

    /**
     * @param  array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            scrollX: $attributes['scroll_x'],
            scrollY: $attributes['scroll_y'],
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
            'scroll_x' => $this->scrollX,
            'scroll_y' => $this->scrollY,
            'type' => $this->type,
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}
