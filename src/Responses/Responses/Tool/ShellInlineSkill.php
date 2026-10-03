<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ShellInlineSkillSourceType from ShellInlineSkillSource
 *
 * @phpstan-type ShellInlineSkillType array{type: 'inline', name: string, description: string, source: ShellInlineSkillSourceType}
 *
 * @implements ResponseContract<ShellInlineSkillType>
 */
final class ShellInlineSkill implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellInlineSkillType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'inline'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $name,
        public readonly string $description,
        public readonly ShellInlineSkillSource $source,
    ) {}

    /**
     * @param  ShellInlineSkillType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            name: $attributes['name'],
            description: $attributes['description'],
            source: ShellInlineSkillSource::from($attributes['source']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'source' => $this->source->toArray(),
        ];
    }
}
