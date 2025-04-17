<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{effort: ?string, generate_summary: ?string}>
 */
final class CreateResponseReasoning implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{effort: ?string, generate_summary: ?string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly ?string $effort,
        public readonly ?string $generate_summary,
    ) {}

    /**
     * @param  array{effort: ?string, generate_summary: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            effort: $attributes['effort'] ?? null,
            generate_summary: $attributes['generate_summary'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'effort' => $this->effort,
            'generate_summary' => $this->generate_summary,
        ];
    }
}
