<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputShellCallActionType array{commands: array<int, string>, max_output_length?: int|null, timeout_ms?: int|null}
 *
 * @implements ResponseContract<OutputShellCallActionType>
 */
final class OutputShellCallAction implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputShellCallActionType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $commands
     */
    private function __construct(
        public readonly array $commands,
        public readonly ?int $maxOutputLength,
        public readonly ?int $timeoutMs,
    ) {}

    /**
     * @param  OutputShellCallActionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            commands: $attributes['commands'],
            maxOutputLength: $attributes['max_output_length'] ?? null,
            timeoutMs: $attributes['timeout_ms'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'commands' => $this->commands,
            'max_output_length' => $this->maxOutputLength,
            'timeout_ms' => $this->timeoutMs,
        ], fn (mixed $value): bool => $value !== null);
    }
}
