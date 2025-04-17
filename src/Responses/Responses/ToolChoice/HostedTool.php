<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\ToolChoice;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'file_search'|'web_search_preview'|'computer_use_preview'}>
 */
final class HostedTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'file_search'|'web_search_preview'|'computer_use_preview'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'file_search'|'web_search_preview'|'computer_use_preview'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  array{type: 'file_search'|'web_search_preview'|'computer_use_preview'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
