<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Assistants\AssistantResponseToolCodeInterpreter;
use OpenAI\Responses\Assistants\AssistantResponseToolFileSearch;
use OpenAI\Responses\Assistants\AssistantResponseToolFunction;
use OpenAI\Responses\Assistants\AssistantResponseToolRetrieval;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, metadata: array<string, string>}>
 */
final class ThreadResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, metadata: array<string, string>, file_ids: array<int, string>, vector_store_ids: array<int, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public array $metadata,
        public array $fileIds,
        public array $vector_store_ids,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, metadata: array<string, string>, file_ids: array<int, string>, vector_store_ids: array<int, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $fileIds = $attributes['tool_resources']['code_interpreter']['file_ids'] ?? [];
        $vectorStoreIds = $attributes['tool_resources']['file_search']['vector_store_ids'] ?? [];

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['metadata'],
            $fileIds,
            $vectorStoreIds,
            $meta,
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
            'metadata' => $this->metadata,
            'file_ids' => $this->fileIds,
            'vector_store_ids' => $this->vector_store_ids,
        ];
    }
}
