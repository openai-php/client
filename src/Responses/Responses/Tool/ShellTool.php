<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ShellContainerAutoType from ShellContainerAuto
 * @phpstan-import-type ShellContainerReferenceType from ShellContainerReference
 * @phpstan-import-type ShellLocalEnvironmentType from ShellLocalEnvironment
 *
 * @phpstan-type ShellToolType array{type: 'shell', environment?: ShellContainerAutoType|ShellContainerReferenceType|ShellLocalEnvironmentType|null, allowed_callers?: array<int, 'direct'|'programmatic'>|null}
 *
 * @implements ResponseContract<ShellToolType>
 */
final class ShellTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'shell'  $type
     * @param  array<int, 'direct'|'programmatic'>|null  $allowedCallers
     */
    private function __construct(
        public readonly string $type,
        public readonly ShellContainerAuto|ShellContainerReference|ShellLocalEnvironment|null $environment,
        public readonly ?array $allowedCallers,
    ) {}

    /**
     * @param  ShellToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            environment: isset($attributes['environment']) ? match ($attributes['environment']['type']) {
                'container_auto' => ShellContainerAuto::from($attributes['environment']),
                'container_reference' => ShellContainerReference::from($attributes['environment']),
                'local' => ShellLocalEnvironment::from($attributes['environment']),
            } : null,
            allowedCallers: $attributes['allowed_callers'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'environment' => $this->environment?->toArray(),
            'allowed_callers' => $this->allowedCallers,
        ], fn (mixed $value): bool => $value !== null);
    }
}
