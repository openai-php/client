<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Environments\Templates;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type AgentEnvironmentTemplateDeleteType array{id: string, object: 'agent.environment.template.deleted', deleted: bool}
 *
 * @implements ResponseContract<AgentEnvironmentTemplateDeleteType>
 */
final class AgentEnvironmentTemplateDeleteResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<AgentEnvironmentTemplateDeleteType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'agent.environment.template.deleted'  $object
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly bool $deleted,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  AgentEnvironmentTemplateDeleteType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            deleted: $attributes['deleted'],
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
            'deleted' => $this->deleted,
        ];
    }
}
