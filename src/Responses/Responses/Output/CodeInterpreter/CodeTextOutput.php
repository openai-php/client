<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\CodeInterpreter;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type CodeTextOutputType array{logs: string, type: 'logs'}
 *
 * @implements ResponseContract<CodeTextOutputType>
 */
final class CodeTextOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<CodeTextOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'logs'  $type
     */
    private function __construct(
        public readonly string $logs,
        public readonly string $type,
    ) {}

    /**
     * @param  CodeTextOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            logs: $attributes['logs'],
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
            'logs' => $this->logs,
        ];
    }
}
