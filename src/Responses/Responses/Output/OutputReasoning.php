<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ReasoningSummaryType from OutputReasoningSummary
 * @phpstan-import-type ReasoningTextType from OutputReasoningText
 *
 * @phpstan-type OutputReasoningType array{id: string, summary: array<int, ReasoningSummaryType>, type: 'reasoning', content?: array<int, ReasoningTextType>|null, encrypted_content: string|null, status?: 'in_progress'|'completed'|'incomplete'|null}
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
     * @param  array<int, OutputReasoningText>|null  $content
     */
    private function __construct(
        public readonly string $id,
        public readonly array $summary,
        public readonly string $type,
        public readonly ?string $encryptedContent,
        public readonly ?string $status,
        public readonly ?array $content = null,
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

        $rawContent = $attributes['content'] ?? null;
        $content = is_array($rawContent)
            ? array_map(
                static fn (array $part): OutputReasoningText => OutputReasoningText::from($part),
                $rawContent,
            )
            : null;

        return new self(
            id: $attributes['id'],
            summary: $summary,
            type: $attributes['type'],
            encryptedContent: $attributes['encrypted_content'] ?? null,
            status: $attributes['status'] ?? null,
            content: $content,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $summary = array_map(
            static fn (OutputReasoningSummary $summary): array => $summary->toArray(),
            $this->summary,
        );

        if ($this->content === null) {
            return [
                'id' => $this->id,
                'summary' => $summary,
                'type' => $this->type,
                'encrypted_content' => $this->encryptedContent,
                'status' => $this->status,
            ];
        }

        return [
            'id' => $this->id,
            'summary' => $summary,
            'type' => $this->type,
            'content' => array_map(
                static fn (OutputReasoningText $part): array => $part->toArray(),
                $this->content,
            ),
            'encrypted_content' => $this->encryptedContent,
            'status' => $this->status,
        ];
    }
}
