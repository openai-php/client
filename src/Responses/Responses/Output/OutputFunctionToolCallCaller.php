<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputFunctionToolCallCallerType array{type: 'direct'|'program', caller_id?: string}
 *
 * @implements ResponseContract<OutputFunctionToolCallCallerType>
 */
final class OutputFunctionToolCallCaller implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputFunctionToolCallCallerType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'direct'|'program'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $callerId,
    ) {}

    /**
     * @param  OutputFunctionToolCallCallerType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            callerId: $attributes['caller_id'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'caller_id' => $this->callerId,
        ], fn (mixed $value): bool => $value !== null);
    }
}
