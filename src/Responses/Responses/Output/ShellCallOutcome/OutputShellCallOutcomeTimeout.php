<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ShellCallOutcome;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputShellCallOutcomeTimeoutType array{type: 'timeout'}
 *
 * @implements ResponseContract<OutputShellCallOutcomeTimeoutType>
 */
final class OutputShellCallOutcomeTimeout implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputShellCallOutcomeTimeoutType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'timeout'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  OutputShellCallOutcomeTimeoutType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
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
        ];
    }
}
