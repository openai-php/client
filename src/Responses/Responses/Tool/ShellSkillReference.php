<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ShellSkillReferenceType array{type: 'skill_reference', skill_id: string, version?: string}
 *
 * @implements ResponseContract<ShellSkillReferenceType>
 */
final class ShellSkillReference implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellSkillReferenceType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'skill_reference'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $skillId,
        public readonly ?string $version,
    ) {}

    /**
     * @param  ShellSkillReferenceType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            skillId: $attributes['skill_id'],
            version: $attributes['version'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'skill_id' => $this->skillId,
            'version' => $this->version,
        ], fn (mixed $value): bool => $value !== null);
    }
}
