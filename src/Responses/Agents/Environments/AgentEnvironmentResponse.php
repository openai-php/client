<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Environments;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type AgentEnvironmentFileType array{type: 'file_id', id: string, file_id: string, path: string, size_bytes: int}|array{type: 'inline', id: string, path: string, size_bytes: int}
 * @phpstan-type AgentEnvironmentPluginType array{type: 'inline', name: string, description: string}
 * @phpstan-type AgentEnvironmentSkillType array{type: 'skill_reference', skill_id: string, version: string, name: string, description: string}|array{type: 'inline', name: string, description: string}
 * @phpstan-type AgentEnvironmentType array{id: string, object: 'agent.environment', type: string, status: string, files: array<int, AgentEnvironmentFileType>, plugins: array<int, AgentEnvironmentPluginType>, skills: array<int, AgentEnvironmentSkillType>}
 *
 * @implements ResponseContract<AgentEnvironmentType>
 */
final class AgentEnvironmentResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<AgentEnvironmentType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'agent.environment'  $object
     * @param  array<int, AgentEnvironmentFileType>  $files
     * @param  array<int, AgentEnvironmentPluginType>  $plugins
     * @param  array<int, AgentEnvironmentSkillType>  $skills
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly string $type,
        public readonly string $status,
        public readonly array $files,
        public readonly array $plugins,
        public readonly array $skills,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  AgentEnvironmentType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            type: $attributes['type'],
            status: $attributes['status'],
            files: $attributes['files'],
            plugins: $attributes['plugins'],
            skills: $attributes['skills'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'type' => $this->type,
            'status' => $this->status,
            'files' => $this->files,
            'plugins' => $this->plugins,
            'skills' => $this->skills,
        ];
    }
}
