<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputCodeInterpreterToolCallType array{id: string, status: string, type: 'code_interpreter_call'}
 *
 * @implements ResponseContract<OutputCodeInterpreterToolCallType>
 */
final class OutputCodeInterpreterToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputCodeInterpreterToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'code_interpreter_call'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputCodeInterpreterToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            status: $attributes['status'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}