<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, summary: array<int, array{text: string, type: 'summary_text'}>, type: 'reasoning', status: 'in_progress'|'completed'|'incomplete'}>
 */
final class OutputReasoning implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, summary: array<int, array{text: string, type: 'summary_text'}>, type: 'reasoning', status: 'in_progress'|'completed'|'incomplete'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, OutputReasoningSummary>  $summary
     * @param  'reasoning'  $type
     * @param  'in_progress'|'completed'|'incomplete'  $status
     */
    private function __construct(
        public readonly string $id,
        public readonly array $summary,
        public readonly string $type,
        public readonly string $status,
    ) {}

    /**
     * @param  array{id: string, summary: array<int, array{text: string, type: 'summary_text'}>, type: 'reasoning', status: 'in_progress'|'completed'|'incomplete'}  $attributes
     */
    public static function from(array $attributes): self
    {
        $summary = array_map(
            static fn (array $summary): OutputReasoningSummary => OutputReasoningSummary::from($summary),
            $attributes['summary'],
        );

        return new self(
            id: $attributes['id'],
            summary: $summary,
            type: $attributes['type'],
            status: $attributes['status'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'summary' => array_map(
                static fn (OutputReasoningSummary $summary): array => $summary->toArray(),
                $this->summary,
            ),
            'type' => $this->type,
            'status' => $this->status,
        ];
    }
}
