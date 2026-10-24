<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Sessions;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Agents\Sessions\Objects\SessionAgent;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponseUsage;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type SessionAgentType from SessionAgent
 * @phpstan-import-type UsageType from CreateResponseUsage
 *
 * @phpstan-type AgentSessionEnvironmentType array{type: 'none'}|array{type: 'openai_hosted', id: string, capability_directories: array<int, string>, desktop: array{enabled: bool}, files: array<int, array<string, mixed>>, network: array{access: string, allowed_domains: array<int, string>}, packages: array{npm: array<int, string>, python: array<int, string>, system: array<int, string>}, plugins: array<int, array<string, mixed>>, skills: array<int, array<string, mixed>>, container_size?: string|null}|array{type: 'self_hosted', id: string, capability_directories: array<int, string>, remote_url: string, workspace_directory: string}
 * @phpstan-type AgentSessionRequiredActionType array{type: 'computer_use_approval_request', request_id: string, turn_id: string, request: array<string, mixed>}|array{type: 'function_call', call_id: string, name: string, arguments: mixed, turn_id: string}|array{type: 'environment_connection', environment_id: string}
 * @phpstan-type AgentSessionType array{id: string, object: 'agent.session', created_at: int, last_active_at: int, status: string, error: string|null, metadata: array<string, string>, vault_ids: array<int, string>, agent: SessionAgentType, environment: AgentSessionEnvironmentType, required_actions: array<int, AgentSessionRequiredActionType>, usage: UsageType|null}
 *
 * @implements ResponseContract<AgentSessionType>
 */
final class AgentSessionResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<AgentSessionType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'agent.session'  $object
     * @param  array<string, string>  $metadata
     * @param  array<int, string>  $vaultIds
     * @param  AgentSessionEnvironmentType  $environment
     * @param  array<int, AgentSessionRequiredActionType>  $requiredActions
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly int $lastActiveAt,
        public readonly string $status,
        public readonly ?string $error,
        public readonly array $metadata,
        public readonly array $vaultIds,
        public readonly SessionAgent $agent,
        public readonly array $environment,
        public readonly array $requiredActions,
        public readonly ?CreateResponseUsage $usage,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  AgentSessionType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            lastActiveAt: $attributes['last_active_at'],
            status: $attributes['status'],
            error: $attributes['error'],
            metadata: $attributes['metadata'],
            vaultIds: $attributes['vault_ids'],
            agent: SessionAgent::from($attributes['agent']),
            environment: $attributes['environment'],
            requiredActions: $attributes['required_actions'],
            usage: isset($attributes['usage']) ? CreateResponseUsage::from($attributes['usage']) : null,
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
            'last_active_at' => $this->lastActiveAt,
            'status' => $this->status,
            'error' => $this->error,
            'metadata' => $this->metadata,
            'vault_ids' => $this->vaultIds,
            'agent' => $this->agent->toArray(),
            'environment' => $this->environment,
            'required_actions' => $this->requiredActions,
            'usage' => $this->usage?->toArray(),
        ];
    }
}
