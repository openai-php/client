<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type NamespaceToolType array{description: string, name: string, tools: mixed, type: 'namespace'}
 *
 * @implements ResponseContract<NamespaceToolType>
 */
final class NamespaceTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<NamespaceToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'namespace'  $type
     */
    private function __construct(
        public readonly string $description,
        public readonly string $name,
        public readonly mixed $tools,
        public readonly string $type,
    ) {}

    /**
     * @param  NamespaceToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            description: $attributes['description'],
            name: $attributes['name'],
            tools: $attributes['tools'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'name' => $this->name,
            'tools' => $this->tools,
            'type' => $this->type,
        ];
    }
}
