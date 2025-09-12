<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputLocalShellCallActionType array{command: array<int, string>, env: array<int, string>, type: 'exec', timeout_ms: ?int, user: ?string, working_directory: ?string}
 *
 * @implements ResponseContract<OutputLocalShellCallActionType>
 */
final class OutputLocalShellCallAction implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputLocalShellCallActionType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $command
     * @param  array<int, string>  $env
     * @param  'exec'  $type
     */
    private function __construct(
        public readonly array $command,
        public readonly array $env,
        public readonly string $type,
        public readonly ?int $timeoutMs,
        public readonly ?string $user,
        public readonly ?string $workingDirectory,
    ) {}

    /**
     * @param  OutputLocalShellCallActionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            command: $attributes['command'],
            env: $attributes['env'],
            type: $attributes['type'],
            timeoutMs: $attributes['timeout_ms'] ?? null,
            user: $attributes['user'] ?? null,
            workingDirectory: $attributes['working_directory'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'command' => $this->command,
            'env' => $this->env,
            'type' => $this->type,
            'timeout_ms' => $this->timeoutMs,
            'user' => $this->user,
            'working_directory' => $this->workingDirectory,
        ];
    }
}
