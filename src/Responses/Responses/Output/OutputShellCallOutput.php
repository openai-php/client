<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputFunctionToolCallCallerType from OutputFunctionToolCallCaller
 * @phpstan-import-type OutputShellCallOutputContentType from OutputShellCallOutputContent
 *
 * @phpstan-type OutputShellCallOutputType array{type: 'shell_call_output', id?: string|null, status?: 'in_progress'|'completed'|'incomplete'|null, call_id: string, caller?: OutputFunctionToolCallCallerType|null, created_by?: string, output: array<int, OutputShellCallOutputContentType>, max_output_length?: int|null}
 *
 * @implements ResponseContract<OutputShellCallOutputType>
 */
final class OutputShellCallOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputShellCallOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'shell_call_output'  $type
     * @param  'in_progress'|'completed'|'incomplete'|null  $status
     * @param  array<int, OutputShellCallOutputContent>  $output
     */
    private function __construct(
        public readonly ?string $id,
        public readonly string $type,
        public readonly ?string $status,
        public readonly string $callId,
        public readonly array $output,
        public readonly ?int $maxOutputLength,
        public readonly ?OutputFunctionToolCallCaller $caller,
        public readonly ?string $createdBy,
    ) {}

    /**
     * @param  OutputShellCallOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'] ?? null,
            type: $attributes['type'],
            status: $attributes['status'] ?? null,
            callId: $attributes['call_id'],
            output: array_map(fn (array $output): OutputShellCallOutputContent => OutputShellCallOutputContent::from($output), $attributes['output']),
            maxOutputLength: $attributes['max_output_length'] ?? null,
            caller: isset($attributes['caller']) ? OutputFunctionToolCallCaller::from($attributes['caller']) : null,
            createdBy: $attributes['created_by'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'status' => $this->status,
            'call_id' => $this->callId,
            'output' => array_map(fn (OutputShellCallOutputContent $output): array => $output->toArray(), $this->output),
            'max_output_length' => $this->maxOutputLength,
            'caller' => $this->caller?->toArray(),
            'created_by' => $this->createdBy,
        ], fn (mixed $value): bool => $value !== null);
    }
}
