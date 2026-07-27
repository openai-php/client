<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ProgrammaticToolCallingToolType array{type: 'programmatic_tool_calling'}
 *
 * @implements ResponseContract<ProgrammaticToolCallingToolType>
 */
final class ProgrammaticToolCallingTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<ProgrammaticToolCallingToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'programmatic_tool_calling'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  ProgrammaticToolCallingToolType  $attributes
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
