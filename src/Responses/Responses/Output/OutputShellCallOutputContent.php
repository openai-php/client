<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\ShellCallOutcome\OutputShellCallOutcomeExit;
use OpenAI\Responses\Responses\Output\ShellCallOutcome\OutputShellCallOutcomeTimeout;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputShellCallOutcomeExitType from OutputShellCallOutcomeExit
 * @phpstan-import-type OutputShellCallOutcomeTimeoutType from OutputShellCallOutcomeTimeout
 *
 * @phpstan-type OutputShellCallOutputContentType array{stdout: string, stderr: string, outcome: OutputShellCallOutcomeExitType|OutputShellCallOutcomeTimeoutType, created_by?: string}
 *
 * @implements ResponseContract<OutputShellCallOutputContentType>
 */
final class OutputShellCallOutputContent implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputShellCallOutputContentType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly string $stdout,
        public readonly string $stderr,
        public readonly OutputShellCallOutcomeExit|OutputShellCallOutcomeTimeout $outcome,
        public readonly ?string $createdBy,
    ) {}

    /**
     * @param  OutputShellCallOutputContentType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            stdout: $attributes['stdout'],
            stderr: $attributes['stderr'],
            outcome: match ($attributes['outcome']['type']) {
                'exit' => OutputShellCallOutcomeExit::from($attributes['outcome']),
                'timeout' => OutputShellCallOutcomeTimeout::from($attributes['outcome']),
            },
            createdBy: $attributes['created_by'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'stdout' => $this->stdout,
            'stderr' => $this->stderr,
            'outcome' => $this->outcome->toArray(),
            'created_by' => $this->createdBy,
        ], fn (mixed $value): bool => $value !== null);
    }
}
