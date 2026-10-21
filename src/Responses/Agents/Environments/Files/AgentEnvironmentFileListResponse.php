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
 * @phpstan-import-type AgentEnvironmentFileType from AgentEnvironmentFileResponse
 *
 * @phpstan-type AgentEnvironmentFileListType array{object: 'page', data: AgentEnvironmentFileType[], has_more: bool, next: string|null}
 *
 * @implements ResponseContract<AgentEnvironmentFileListType>
 */
final class AgentEnvironmentFileListResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<AgentEnvironmentFileListType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'page'  $object
     * @param  AgentEnvironmentFileResponse[]  $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly bool $hasMore,
        public readonly ?string $next,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  AgentEnvironmentFileListType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            object: $attributes['object'],
            data: array_map(
                fn (array $result): AgentEnvironmentFileResponse => AgentEnvironmentFileResponse::from($result, $meta),
                $attributes['data']
            ),
            hasMore: $attributes['has_more'],
            next: $attributes['next'] ?? null,
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
            'data' => array_map(
                static fn (AgentEnvironmentFileResponse $result): array => $result->toArray(),
                $this->data,
            ),
            'has_more' => $this->hasMore,
            'next' => $this->next,
        ];
    }
}
