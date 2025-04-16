<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{text: string, type: 'summary_text'}>
 */
final class OutputReasoningSummary implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{text: string, type: 'summary_text'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'summary_text'  $type
     */
    private function __construct(
        public readonly string $text,
        public readonly string $type,
    ) {}

    /**
     * @param  array{text: string, type: 'summary_text'}  $attributes
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
