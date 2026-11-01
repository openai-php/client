<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\ToolChoice;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type HostedToolChoiceType array{type: 'shell'|'apply_patch'|'file_search'|'web_search'|'web_search_preview'|'web_search_preview_2025_03_11'|'computer'|'computer_use'|'computer_use_preview'|'code_interpreter'|'image_generation'|'programmatic_tool_calling'}
 *
 * @implements ResponseContract<HostedToolChoiceType>
 */
final class HostedToolChoice implements ResponseContract
{
    /**
     * @use ArrayAccessible<HostedToolChoiceType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'shell'|'apply_patch'|'file_search'|'web_search'|'web_search_preview'|'web_search_preview_2025_03_11'|'computer'|'computer_use'|'computer_use_preview'|'code_interpreter'|'image_generation'|'programmatic_tool_calling'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  HostedToolChoiceType  $attributes
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
