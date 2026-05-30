<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool\CustomToolInputs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type GrammarInputType array{type: 'grammar', definition: string, syntax: string}
 *
 * @implements ResponseContract<GrammarInputType>
 */
final class GrammarInput implements ResponseContract
{
    /**
     * @use ArrayAccessible<GrammarInputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'grammar'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $definition,
        public readonly string $syntax,
    ) {}

    /**
     * @param  GrammarInputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            definition: $attributes['definition'],
            syntax: $attributes['syntax'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'definition' => $this->definition,
            'syntax' => $this->syntax,
        ];
    }
}
