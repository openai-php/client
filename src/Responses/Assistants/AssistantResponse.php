<?php

declare(strict_types=1);

namespace OpenAI\Responses\Assistants;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'file_search'}>, file_ids: array<int, string>, vector_store_ids: array<int, string>>
 */
final class AssistantResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'file_search'}>, file_ids: array<int, string>, vector_store_ids: array<int, string>>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, AssistantResponseToolCodeInterpreter|AssistantResponseToolRetrieval|AssistantResponseToolFileSearch|AssistantResponseToolFunction>  $tools
     * @param  array<int, string>  $fileIds
     * @param  array<int, string>  $vector_store_ids
     */
    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public ?string $name,
        public ?string $description,
        public string $model,
        public ?string $instructions,
        public array $tools,
        public array $fileIds,
        public array $vector_store_ids
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'file_search'}>, file_ids: array<int, string>, vector_store_ids: array<int, string>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $tools = array_map(
            fn (array $tool): AssistantResponseToolCodeInterpreter|AssistantResponseToolRetrieval|AssistantResponseToolFileSearch|AssistantResponseToolFunction => match ($tool['type']) {
                'code_interpreter' => AssistantResponseToolCodeInterpreter::from($tool),
                'retrieval' => AssistantResponseToolRetrieval::from($tool),
                'file_search' => AssistantResponseToolFileSearch::from($tool),
                'function' => AssistantResponseToolFunction::from($tool),
            },
            $attributes['tools'],
        );
        $fileIds = $toolResources['code_interpreter']['file_ids'] ?? [];
        $vectorStoreIds = $toolResources['file_search']['vector_store_ids'] ?? [];

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['name'],
            $attributes['description'],
            $attributes['model'],
            $attributes['instructions'],
            $tools,
            $fileIds,
            $vectorStoreIds,
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
            'name' => $this->name,
            'description' => $this->description,
            'model' => $this->model,
            'instructions' => $this->instructions,
            'tools' => array_map(fn (AssistantResponseToolCodeInterpreter|AssistantResponseToolRetrieval|AssistantResponseToolFileSearch|AssistantResponseToolFunction $tool): array => $tool->toArray(), $this->tools),
            'file_ids' => $this->fileIds,
            'vector_store_ids' => $this->vector_store_ids,
        ];
    }
}
