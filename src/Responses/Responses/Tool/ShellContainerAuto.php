<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ShellSkillReferenceType from ShellSkillReference
 * @phpstan-import-type ShellInlineSkillType from ShellInlineSkill
 *
 * @phpstan-type ShellContainerAutoType array{type: 'container_auto', file_ids?: array<int, string>, memory_limit?: '1g'|'4g'|'16g'|'64g'|null, network_policy?: array{type: 'disabled'}|array{type: 'allowlist', allowed_domains: array<int, string>, domain_secrets?: array<int, array{domain: string, name: string, value: string}>}, skills?: array<int, ShellSkillReferenceType|ShellInlineSkillType>}
 *
 * @implements ResponseContract<ShellContainerAutoType>
 */
final class ShellContainerAuto implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellContainerAutoType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'container_auto'  $type
     * @param  array<int, string>|null  $fileIds
     * @param  '1g'|'4g'|'16g'|'64g'|null  $memoryLimit
     * @param  array{type: 'disabled'}|array{type: 'allowlist', allowed_domains: array<int, string>, domain_secrets?: array<int, array{domain: string, name: string, value: string}>}|null  $networkPolicy
     * @param  array<int, ShellSkillReference|ShellInlineSkill>|null  $skills
     */
    private function __construct(
        public readonly string $type,
        public readonly ?array $fileIds,
        public readonly ?string $memoryLimit,
        public readonly ?array $networkPolicy,
        public readonly ?array $skills,
    ) {}

    /**
     * @param  ShellContainerAutoType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            fileIds: $attributes['file_ids'] ?? null,
            memoryLimit: $attributes['memory_limit'] ?? null,
            networkPolicy: $attributes['network_policy'] ?? null,
            skills: isset($attributes['skills']) ? array_map(fn (array $skill): ShellSkillReference|ShellInlineSkill => match ($skill['type']) {
                'skill_reference' => ShellSkillReference::from($skill),
                'inline' => ShellInlineSkill::from($skill),
            }, $attributes['skills']) : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'file_ids' => $this->fileIds,
            'memory_limit' => $this->memoryLimit,
            'network_policy' => $this->networkPolicy,
            'skills' => $this->skills === null ? null : array_map(fn (ShellSkillReference|ShellInlineSkill $skill): array => $skill->toArray(), $this->skills),
        ], fn (mixed $value): bool => $value !== null);
    }
}
