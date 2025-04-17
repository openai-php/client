<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ComputerAction;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{text: string, type: 'type'}>
 */
final class OutputComputerActionType implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{text: string, type: 'type'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'type'  $type
     */
    private function __construct(
        public readonly string $text,
        public readonly string $type,
    ) {}

    /**
     * @param  array{text: string, type: 'type'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            text: $attributes['text'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'type' => $this->type,
        ];
    }
}
