<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type MultiAgentType array{enabled: bool, max_concurrent_subagents: int|null}
 *
 * @implements ResponseContract<MultiAgentType>
 */
final class MultiAgent implements ResponseContract
{
    /**
     * @use ArrayAccessible<MultiAgentType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly bool $enabled,
        public readonly ?int $maxConcurrentSubagents,
    ) {}

    /**
     * @param  MultiAgentType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            enabled: $attributes['enabled'],
            maxConcurrentSubagents: $attributes['max_concurrent_subagents'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled,
            'max_concurrent_subagents' => $this->maxConcurrentSubagents,
        ];
    }
}
