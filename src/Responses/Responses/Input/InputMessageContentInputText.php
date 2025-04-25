<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ContentInputTextType array{text: string, type: 'input_text'}
 *
 * @implements ResponseContract<ContentInputTextType>
 */
final class InputMessageContentInputText implements ResponseContract
{
    /**
     * @use ArrayAccessible<ContentInputTextType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'input_text'  $type
     */
    private function __construct(
        public readonly string $text,
        public readonly string $type
    ) {}

    /**
     * @param  ContentInputTextType  $attributes
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
