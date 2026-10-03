<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ShellLocalSkillType array{name: string, description: string, path: string}
 *
 * @implements ResponseContract<ShellLocalSkillType>
 */
final class ShellLocalSkill implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellLocalSkillType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $path,
    ) {}

    /**
     * @param  ShellLocalSkillType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            description: $attributes['description'],
            path: $attributes['path'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'path' => $this->path,
        ];
    }
}
