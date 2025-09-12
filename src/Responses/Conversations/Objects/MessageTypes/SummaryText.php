<?php

declare(strict_types=1);

namespace OpenAI\Responses\Conversations\Objects\MessageTypes;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type SummaryTextType array{text: string, type: 'summary_text'}
 *
 * @implements ResponseContract<SummaryTextType>
 */
final class SummaryText implements ResponseContract
{
    /**
     * @use ArrayAccessible<SummaryTextType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'summary_text'  $type
     */
    private function __construct(
        public readonly string $text,
        public readonly string $type
    ) {}

    /**
     * @param  SummaryTextType  $attributes
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
