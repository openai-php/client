<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ComputerToolCallOutputScreenshotType from ComputerToolCallOutputScreenshot
 * @phpstan-import-type AcknowledgedSafetyCheckType from AcknowledgedSafetyCheck
 *
 * @phpstan-type ComputerToolCallOutputType array{call_id: string, id: string, output: ComputerToolCallOutputScreenshotType, type: 'computer_call_output', acknowledged_safety_checks?: array<int, AcknowledgedSafetyCheckType>, status: 'in_progress'|'completed'|'incomplete', current_url?: string|null}
 *
 * @implements ResponseContract<ComputerToolCallOutputType>
 */
final class ComputerToolCallOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<ComputerToolCallOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'computer_call_output'  $type
     * @param  array<int, AcknowledgedSafetyCheck>  $acknowledgedSafetyChecks
     * @param  'in_progress'|'completed'|'incomplete'  $status
     */
    private function __construct(
        public readonly string $callId,
        public readonly string $id,
        public readonly ComputerToolCallOutputScreenshot $output,
        public readonly string $type,
        public readonly array $acknowledgedSafetyChecks,
        public readonly string $status,
        public readonly ?string $currentUrl,
    ) {}

    /**
     * @param  ComputerToolCallOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        $acknowledgedSafetyChecks = array_map(
            fn (array $acknowledgedSafetyCheck) => AcknowledgedSafetyCheck::from($acknowledgedSafetyCheck),
            $attributes['acknowledged_safety_checks'] ?? [],
        );

        return new self(
            callId: $attributes['call_id'],
            id: $attributes['id'],
            output: ComputerToolCallOutputScreenshot::from($attributes['output']),
            type: $attributes['type'],
            acknowledgedSafetyChecks: $acknowledgedSafetyChecks,
            status: $attributes['status'],
            currentUrl: $attributes['current_url'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'call_id' => $this->callId,
            'id' => $this->id,
            'output' => $this->output->toArray(),
            'type' => $this->type,
            'acknowledged_safety_checks' => array_map(
                fn (AcknowledgedSafetyCheck $acknowledgedSafetyCheck) => $acknowledgedSafetyCheck->toArray(),
                $this->acknowledgedSafetyChecks,
            ),
            'status' => $this->status,
            'current_url' => $this->currentUrl,
        ], fn (mixed $value): bool => $value !== null);
    }
}
