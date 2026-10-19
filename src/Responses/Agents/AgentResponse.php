<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Agents\Objects\MultiAgent;
use OpenAI\Responses\Agents\Objects\Reasoning;
use OpenAI\Responses\Agents\Objects\Text;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type MultiAgentType from MultiAgent
 * @phpstan-import-type ReasoningType from Reasoning
 * @phpstan-import-type TextType from Text
 *
 * @phpstan-type AgentToolType array{type: 'function', name: string, description: string, parameters: array<string, mixed>, defer_loading: bool}|array{type: 'tool_search'}|array{type: 'programmatic_tool_calling', enabled: bool}|array{type: 'mcp', server_label: string, transport: array{type: 'http', server_url: string, headers: array<string, string>}|array{type: 'stdio', command: string, cwd: string, args: array<int, string>, env_vars: array<int, string>}, allowed_tools: array<int, string>|null, connection_origin: string, credential_id: string|null, request_metadata: array<string, mixed>, required: bool}|array{type: 'web_search', allowed_domains: array<int, string>|null, context_size: string, location: array{city: string|null, country: string|null, region: string|null, timezone: string|null}|null, mode: string}|array{type: 'computer_use', include_screenshots: bool}
 * @phpstan-type AgentType array{id: string, object: 'agent', created_at: int, updated_at: int, model: string, name: string|null, instructions: string|null, metadata: array<string, string>, multi_agent: MultiAgentType, reasoning: ReasoningType, service_tier: string, text: TextType, tools: array<int, AgentToolType>}
 *
 * @implements ResponseContract<AgentType>
 */
final class AgentResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<AgentType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'agent'  $object
     * @param  array<string, string>  $metadata
     * @param  array<int, AgentToolType>  $tools
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly int $updatedAt,
        public readonly string $model,
        public readonly ?string $name,
        public readonly ?string $instructions,
        public readonly array $metadata,
        public readonly MultiAgent $multiAgent,
        public readonly Reasoning $reasoning,
        public readonly string $serviceTier,
        public readonly Text $text,
        public readonly array $tools,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  AgentType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            updatedAt: $attributes['updated_at'],
            model: $attributes['model'],
            name: $attributes['name'],
            instructions: $attributes['instructions'],
            metadata: $attributes['metadata'],
            multiAgent: MultiAgent::from($attributes['multi_agent']),
            reasoning: Reasoning::from($attributes['reasoning']),
            serviceTier: $attributes['service_tier'],
            text: Text::from($attributes['text']),
            tools: $attributes['tools'],
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
            'model' => $this->model,
            'name' => $this->name,
            'instructions' => $this->instructions,
            'metadata' => $this->metadata,
            'multi_agent' => $this->multiAgent->toArray(),
            'reasoning' => $this->reasoning->toArray(),
            'service_tier' => $this->serviceTier,
            'text' => $this->text->toArray(),
            'tools' => $this->tools,
        ];
    }
}
