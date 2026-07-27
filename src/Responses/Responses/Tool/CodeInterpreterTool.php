<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type CodeInterpreterContainerAutoType from CodeInterpreterContainerAuto
 *
 * @phpstan-type CodeInterpreterToolType array{container: string|CodeInterpreterContainerAutoType, type: 'code_interpreter', allowed_callers?: array<int, 'direct'|'programmatic'>|null}
 *
 * @implements ResponseContract<CodeInterpreterToolType>
 */
final class CodeInterpreterTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<CodeInterpreterToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'code_interpreter'  $type
     * @param  array<int, 'direct'|'programmatic'>|null  $allowedCallers
     */
    private function __construct(
        public readonly string|CodeInterpreterContainerAuto $container,
        public readonly string $type,
        public readonly ?array $allowedCallers = null,
    ) {}

    /**
     * @param  CodeInterpreterToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            container: is_string($attributes['container'])
                ? $attributes['container']
                : CodeInterpreterContainerAuto::from($attributes['container']),
            type: $attributes['type'],
            allowedCallers: $attributes['allowed_callers'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'container' => $this->container instanceof CodeInterpreterContainerAuto
                ? $this->container->toArray()
                : $this->container,
            'type' => $this->type,
            'allowed_callers' => $this->allowedCallers,
        ], fn (mixed $value): bool => $value !== null);
    }
}
