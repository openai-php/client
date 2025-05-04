<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ReasoningSummaryType from OutputReasoningSummary
 *
 * @phpstan-type OutputReasoningType array{id: string, summary: array<int, ReasoningSummaryType>, type: 'reasoning', encrypted_content: string|null, status?: 'in_progress'|'completed'|'incomplete'|null}
 *
 * @implements ResponseContract<OutputReasoningType>
 */
final class OutputReasoning implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputReasoningType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, OutputReasoningSummary>  $summary
     * @param  'reasoning'  $type
     * @param  'in_progress'|'completed'|'incomplete'|null  $status
     */
    private function __construct(
        public readonly string $id,
        public readonly array $summary,
        public readonly string $type,
        public readonly ?string $encryptedContent,
        public readonly ?string $status,
    ) {}

    /**
     * @param  OutputReasoningType  $attributes
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
            encryptedContent: $attributes['encrypted_content'] ?? null,
            status: $attributes['status'] ?? null,
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
            'encrypted_content' => $this->encryptedContent,
            'status' => $this->status,
        ];
    }
}
