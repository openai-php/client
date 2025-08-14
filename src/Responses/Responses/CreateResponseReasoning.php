<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ReasoningType array{effort: ?string, generate_summary: ?string, summary: ?string}
 *
 * @implements ResponseContract<ReasoningType>
 */
final class CreateResponseReasoning implements ResponseContract
{
    /**
     * @use ArrayAccessible<ReasoningType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly ?string $effort,
        public readonly ?string $generateSummary,
        public readonly ?string $summary,
    ) {}

    /**
     * @param  ReasoningType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            effort: $attributes['effort'] ?? null,
            generateSummary: $attributes['generate_summary'] ?? null,
            summary: $attributes['summary'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'effort' => $this->effort,
            'generate_summary' => $this->generateSummary,
            'summary' => $this->summary,
        ];
    }
}
