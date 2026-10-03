<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ShellCallOutcome;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputShellCallOutcomeExitType array{type: 'exit', exit_code: int}
 *
 * @implements ResponseContract<OutputShellCallOutcomeExitType>
 */
final class OutputShellCallOutcomeExit implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputShellCallOutcomeExitType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'exit'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly int $exitCode,
    ) {}

    /**
     * @param  OutputShellCallOutcomeExitType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            exitCode: $attributes['exit_code'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'exit_code' => $this->exitCode,
        ];
    }
}
