<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ShellLocalSkillType from ShellLocalSkill
 *
 * @phpstan-type ShellLocalEnvironmentType array{type: 'local', skills?: array<int, ShellLocalSkillType>}
 *
 * @implements ResponseContract<ShellLocalEnvironmentType>
 */
final class ShellLocalEnvironment implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellLocalEnvironmentType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'local'  $type
     * @param  array<int, ShellLocalSkill>|null  $skills
     */
    private function __construct(
        public readonly string $type,
        public readonly ?array $skills,
    ) {}

    /**
     * @param  ShellLocalEnvironmentType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            skills: isset($attributes['skills']) ? array_map(fn (array $skill): ShellLocalSkill => ShellLocalSkill::from($skill), $attributes['skills']) : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'skills' => $this->skills === null ? null : array_map(fn (ShellLocalSkill $skill): array => $skill->toArray(), $this->skills),
        ], fn (mixed $value): bool => $value !== null);
    }
}
