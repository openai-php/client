<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'screenshot'}>
 */
final class OutputComputerActionScreenshot implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'screenshot'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'screenshot'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  array{type: 'screenshot'}  $attributes
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
