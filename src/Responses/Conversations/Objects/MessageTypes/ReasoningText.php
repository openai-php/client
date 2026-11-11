<?php

declare(strict_types=1);

namespace OpenAI\Responses\Conversations\Objects\MessageTypes;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ReasoningTextType array{text: string, type: 'reasoning_text'}
 *
 * @implements ResponseContract<ReasoningTextType>
 */
final class ReasoningText implements ResponseContract
{
    /**
     * @use ArrayAccessible<ReasoningTextType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'reasoning_text'  $type
     */
    private function __construct(
        public readonly string $text,
        public readonly string $type
    ) {}

    /**
     * @param  ReasoningTextType  $attributes
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
