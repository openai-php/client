<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputCustomToolCallType array{call_id: string, input: string, name: string, type: 'custom_tool_call', id: string}
 *
 * @implements ResponseContract<OutputCustomToolCallType>
 */
final class OutputCustomToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputCustomToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'custom_tool_call'  $type
     */
    private function __construct(
        public readonly string $callId,
        public readonly string $input,
        public readonly string $name,
        public readonly string $id,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputCustomToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            callId: $attributes['call_id'],
            input: $attributes['input'],
            name: $attributes['name'],
            id: $attributes['id'],
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
            'call_id' => $this->callId,
            'input' => $this->input,
            'name' => $this->name,
            'id' => $this->id,
        ];
    }
}
