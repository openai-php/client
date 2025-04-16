<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{keys: array<int, string>, type: 'keypress'}>
 */
final class OutputComputerActionKeyPress implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{keys: array<int, string>, type: 'keypress'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $keys
     * @param  'keypress'  $type
     */
    private function __construct(
        public readonly array $keys,
        public readonly string $type,
    ) {}

    /**
     * @param  array{keys: array<int, string>, type: 'keypress'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            keys: $attributes['keys'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'keys' => $this->keys,
            'type' => $this->type,
        ];
    }
}
