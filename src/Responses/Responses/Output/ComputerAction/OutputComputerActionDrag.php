<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type DragPathType from OutputComputerDragPath
 *
 * @phpstan-type DragType array{path: array<int, DragPathType>, type: 'drag'}
 *
 * @implements ResponseContract<DragType>
 */
final class OutputComputerActionDrag implements ResponseContract
{
    /**
     * @use ArrayAccessible<DragType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, OutputComputerDragPath>  $path
     * @param  'drag'  $type
     */
    private function __construct(
        public readonly array $path,
        public readonly string $type,
    ) {}

    /**
     * @param  DragType  $attributes
     */
    public static function from(array $attributes): self
    {
        $paths = array_map(
            static fn (array $path): OutputComputerDragPath => OutputComputerDragPath::from($path),
            $attributes['path'],
        );

        return new self(
            path: $paths,
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'path' => array_map(
                static fn (OutputComputerDragPath $path): array => $path->toArray(),
                $this->path,
            ),
            'type' => $this->type,
        ];
    }
}
