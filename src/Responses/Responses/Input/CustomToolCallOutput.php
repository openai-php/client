<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCallCaller;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputFunctionToolCallCallerType from OutputFunctionToolCallCaller
 *
 * @phpstan-type CustomToolCallOutputType array{call_id: string, output: string, type: 'custom_tool_call_output', id: string, caller?: OutputFunctionToolCallCallerType|null}
 *
 * @implements ResponseContract<CustomToolCallOutputType>
 */
final class CustomToolCallOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<CustomToolCallOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'custom_tool_call_output'  $type
     */
    private function __construct(
        public readonly string $callId,
        public readonly string $output,
        public readonly string $type,
        public readonly string $id,
        public readonly ?OutputFunctionToolCallCaller $caller,
    ) {}

    /**
     * @param  CustomToolCallOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            callId: $attributes['call_id'],
            output: $attributes['output'],
            type: $attributes['type'],
            id: $attributes['id'],
            caller: isset($attributes['caller'])
                ? OutputFunctionToolCallCaller::from($attributes['caller'])
                : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'call_id' => $this->callId,
            'id' => $this->id,
            'output' => $this->output,
            'caller' => $this->caller?->toArray(),
        ], fn (mixed $value): bool => $value !== null);
    }
}
