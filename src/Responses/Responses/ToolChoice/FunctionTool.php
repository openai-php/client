<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\ToolChoice;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{name: string, type: 'function'}>
 */
final class FunctionTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{name: string, type: 'function'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'function'  $type
     */
    private function __construct(
        public readonly string $name,
        public readonly string $type,
    ) {}

    /**
     * @param  array{name: string, type: 'function'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}
