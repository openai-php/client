<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ScreenshotType array{type: 'screenshot'}
 *
 * @implements ResponseContract<ScreenshotType>
 */
final class OutputComputerActionScreenshot implements ResponseContract
{
    /**
     * @use ArrayAccessible<ScreenshotType>
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
     * @param  ScreenshotType  $attributes
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
