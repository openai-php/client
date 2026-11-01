<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\ToolChoice;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type AllowedToolsToolChoiceType array{mode: 'auto'|'required', tools: array<int, array<string, mixed>>, type: 'allowed_tools'}
 *
 * @implements ResponseContract<AllowedToolsToolChoiceType>
 */
final class AllowedToolsToolChoice implements ResponseContract
{
    /**
     * @use ArrayAccessible<AllowedToolsToolChoiceType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'auto'|'required'  $mode
     * @param  array<int, array<string, mixed>>  $tools
     * @param  'allowed_tools'  $type
     */
    private function __construct(
        public readonly string $mode,
        public readonly array $tools,
        public readonly string $type,
    ) {}

    /**
     * @param  AllowedToolsToolChoiceType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            mode: $attributes['mode'],
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
            'mode' => $this->mode,
            'tools' => $this->tools,
            'type' => $this->type,
        ];
    }
}
