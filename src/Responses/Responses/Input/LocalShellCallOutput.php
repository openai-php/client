<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type LocalShellCallOutputType array{id: string, output: string, type: 'local_shell_call_output', status: 'in_progress'|'completed'|'incomplete'|null}
 *
 * @implements ResponseContract<LocalShellCallOutputType>
 */
final class LocalShellCallOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<LocalShellCallOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'local_shell_call_output'  $type
     * @param  'in_progress'|'completed'|'incomplete'|null  $status
     */
    private function __construct(
        public readonly string $id,
        public readonly string $output,
        public readonly string $type,
        public readonly ?string $status,
    ) {}

    /**
     * @param  LocalShellCallOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            output: $attributes['output'],
            type: $attributes['type'],
            status: $attributes['status'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'output' => $this->output,
            'status' => $this->status,
        ];
    }
}
