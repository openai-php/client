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
 * @implements ResponseContract<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array<int, array{type: string, function: array{file_ids: array<string>}}|array{type: string, function: array{vector_store_ids: array<string>}}>, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array<int, array{type: string}>}>
 */
final class AssistantResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{ids: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array<int, array{type: 'code_interpreter', function: array{file_ids: array<string>}}|array{type: 'file_search', function: array{vector_store_ids: array<string>}}>, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: ?string|array<int, array{type: 'text'}|array{type: 'json_object'}>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, AssistantResponseToolCodeInterpreter|AssistantResponseToolFileSearch|AssistantResponseToolFunction>  $tools
     * @param  array<int, AssistantResponseToolResourceCodeInterpreter|AssistantResponseToolResourceFileSearch>  $toolResources
     * @param  array<int, string>  $fileIds
     * @param  array<string, string>  $metadata
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
        public array $toolResources,
        public array $metadata,
        private readonly MetaInformation $meta,
        public ?float $temperature,
        public ?float $topP,
        public string|object $responseFormat,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array<int, array{type: 'code_interpreter', function: array{file_ids: array<string>}}|array{type: 'file_search', function: array{vector_store_ids: array<string>}}>, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: ?string|array{type: 'text'}|array{type: 'json_object'}}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $tools = array_map(
            fn (array $tool): AssistantResponseToolCodeInterpreter|AssistantResponseToolFileSearch|AssistantResponseToolFunction => match ($tool['type']) {
                'code_interpreter' => AssistantResponseToolCodeInterpreter::from($tool),
                'file_search' => AssistantResponseToolFileSearch::from($tool),
                'function' => AssistantResponseToolFunction::from($tool),
            },
            $attributes['tools'],
        );

        $toolResources = array_map(
            fn (array $tool): AssistantResponseToolResourceFileSearch|AssistantResponseToolResourceCodeInterpreter => match ($tool['type']) {
                'code_interpreter' => AssistantResponseToolResourceCodeInterpreter::from($tool),
                'file_search' => AssistantResponseToolResourceFileSearch::from($tool),
            },
            $attributes['tool_resources'],
        );

        $responseFormat = is_array($attributes['response_format']) ? match($attributes['response_format']['type']) {
            'text' => AssistantResponseResponseFormatText::from($attributes['response_format']),
            'json_object' => AssistantResponseResponseFormatJsonObject::from($attributes['response_format']),
        } : $attributes['response_format'];

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['name'],
            $attributes['description'],
            $attributes['model'],
            $attributes['instructions'],
            $tools,
            $toolResources,
            $attributes['metadata'],
            $meta,
            $attributes['temperature'],
            $attributes['top_p'],
            $responseFormat
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
            'tools' => array_map(fn (AssistantResponseToolCodeInterpreter|AssistantResponseToolFileSearch|AssistantResponseToolFunction $tool): array => $tool->toArray(), $this->tools),
            'tool_resources' => array_map(fn (AssistantResponseToolResourceCodeInterpreter|AssistantResponseToolResourceFileSearch $toolResources): array => $toolResources->toArray(), $this->toolResources),
            'metadata' => $this->metadata,
            'temperature' => $this->temperature,
            'top_p' => $this->topP,
            'response_format' => $this->responseFormat,
        ];
    }
}
