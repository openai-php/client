<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Sessions\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Agents\AgentResponse;
use OpenAI\Responses\Agents\Objects\MultiAgent;
use OpenAI\Responses\Agents\Objects\Reasoning;
use OpenAI\Responses\Agents\Objects\Text;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type AgentToolType from AgentResponse
 * @phpstan-import-type MultiAgentType from MultiAgent
 * @phpstan-import-type ReasoningType from Reasoning
 * @phpstan-import-type TextType from Text
 *
 * @phpstan-type SessionAgentType array{id: string, model: string, name: string|null, instructions: string|null, multi_agent: MultiAgentType, reasoning: ReasoningType, service_tier: string, text: TextType, tools: array<int, AgentToolType>}
 *
 * @implements ResponseContract<SessionAgentType>
 */
final class SessionAgent implements ResponseContract
{
    /**
     * @use ArrayAccessible<SessionAgentType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, AgentToolType>  $tools
     */
    private function __construct(
        public readonly string $id,
        public readonly string $model,
        public readonly ?string $name,
        public readonly ?string $instructions,
        public readonly MultiAgent $multiAgent,
        public readonly Reasoning $reasoning,
        public readonly string $serviceTier,
        public readonly Text $text,
        public readonly array $tools,
    ) {}

    /**
     * @param  SessionAgentType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            model: $attributes['model'],
            name: $attributes['name'],
            instructions: $attributes['instructions'],
            multiAgent: MultiAgent::from($attributes['multi_agent']),
            reasoning: Reasoning::from($attributes['reasoning']),
            serviceTier: $attributes['service_tier'],
            text: Text::from($attributes['text']),
            tools: $attributes['tools'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'name' => $this->name,
            'instructions' => $this->instructions,
            'multi_agent' => $this->multiAgent->toArray(),
            'reasoning' => $this->reasoning->toArray(),
            'service_tier' => $this->serviceTier,
            'text' => $this->text->toArray(),
            'tools' => $this->tools,
        ];
    }
}
