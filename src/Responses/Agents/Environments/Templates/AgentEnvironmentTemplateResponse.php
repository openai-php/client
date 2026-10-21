<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Environments\Templates;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Agents\Environments\Objects\Desktop;
use OpenAI\Responses\Agents\Environments\Objects\Network;
use OpenAI\Responses\Agents\Environments\Objects\Packages;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type DesktopType from Desktop
 * @phpstan-import-type NetworkType from Network
 * @phpstan-import-type PackagesType from Packages
 *
 * @phpstan-type AgentEnvironmentTemplateFileType array{type: 'file_id', file_id: string, path: string}|array{type: 'inline', path: string, size_bytes: int}
 * @phpstan-type AgentEnvironmentTemplatePluginType array{type: 'inline', name: string, description: string}
 * @phpstan-type AgentEnvironmentTemplateSkillType array{type: 'skill_reference', skill_id: string, version: string|null}|array{type: 'inline', name: string, description: string}
 * @phpstan-type AgentEnvironmentTemplateType array{id: string, object: 'agent.environment.template', created_at: int, updated_at: int, name: string|null, capability_directories: array<int, string>, desktop: DesktopType, network: NetworkType, packages: PackagesType, files: array<int, AgentEnvironmentTemplateFileType>, plugins: array<int, AgentEnvironmentTemplatePluginType>, skills: array<int, AgentEnvironmentTemplateSkillType>}
 *
 * @implements ResponseContract<AgentEnvironmentTemplateType>
 */
final class AgentEnvironmentTemplateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<AgentEnvironmentTemplateType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'agent.environment.template'  $object
     * @param  array<int, string>  $capabilityDirectories
     * @param  array<int, AgentEnvironmentTemplateFileType>  $files
     * @param  array<int, AgentEnvironmentTemplatePluginType>  $plugins
     * @param  array<int, AgentEnvironmentTemplateSkillType>  $skills
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly int $updatedAt,
        public readonly ?string $name,
        public readonly array $capabilityDirectories,
        public readonly Desktop $desktop,
        public readonly Network $network,
        public readonly Packages $packages,
        public readonly array $files,
        public readonly array $plugins,
        public readonly array $skills,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  AgentEnvironmentTemplateType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            updatedAt: $attributes['updated_at'],
            name: $attributes['name'],
            capabilityDirectories: $attributes['capability_directories'],
            desktop: Desktop::from($attributes['desktop']),
            network: Network::from($attributes['network']),
            packages: Packages::from($attributes['packages']),
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
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'name' => $this->name,
            'capability_directories' => $this->capabilityDirectories,
            'desktop' => $this->desktop->toArray(),
            'network' => $this->network->toArray(),
            'packages' => $this->packages->toArray(),
            'files' => $this->files,
            'plugins' => $this->plugins,
            'skills' => $this->skills,
        ];
    }
}
