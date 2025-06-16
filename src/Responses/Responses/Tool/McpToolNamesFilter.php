<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type McpToolNamesFilterType array{tool_names: array<int, string>}
 *
 * @implements ResponseContract<McpToolNamesFilterType>
 */
final class McpToolNamesFilter implements ResponseContract
{
    /**
     * @use ArrayAccessible<McpToolNamesFilterType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $toolNames
     */
    private function __construct(
        public readonly array $toolNames,
    ) {}

    /**
     * @param  McpToolNamesFilterType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            toolNames: $attributes['tool_names'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'tool_names' => $this->toolNames,
        ];
    }
}
