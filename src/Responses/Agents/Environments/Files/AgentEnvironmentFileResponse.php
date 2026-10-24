<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Environments\Files;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type AgentEnvironmentFileType array{object: 'agent.environment.file', environment_id: string, path: string, size_bytes: int}
 *
 * @implements ResponseContract<AgentEnvironmentFileType>
 */
final class AgentEnvironmentFileResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<AgentEnvironmentFileType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'agent.environment.file'  $object
     */
    private function __construct(
        public readonly string $object,
        public readonly string $environmentId,
        public readonly string $path,
        public readonly int $sizeBytes,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  AgentEnvironmentFileType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            object: $attributes['object'],
            environmentId: $attributes['environment_id'],
            path: $attributes['path'],
            sizeBytes: $attributes['size_bytes'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'environment_id' => $this->environmentId,
            'path' => $this->path,
            'size_bytes' => $this->sizeBytes,
        ];
    }
}
