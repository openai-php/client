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
 * @implements ResponseContract<array{id: string, object: string, created_at: int, name: ?string, reasoning_effort?: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: ?string, name: string, parameters: array<string, mixed>}}>, tool_resources: ?array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: string}}>
 */
final class AssistantResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, name: ?string, reasoning_effort?: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: ?string, name: string, parameters: array<string, mixed>}}>, tool_resources: ?array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: string}}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, AssistantResponseToolCodeInterpreter|AssistantResponseToolFileSearch|AssistantResponseToolFunction>  $tools
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public ?string $name,
        public ?string $reasoningEffort,
        public ?string $description,
        public string $model,
        public ?string $instructions,
        public array $tools,
        public ?AssistantResponseToolResources $toolResources,
        public array $metadata,
        public ?float $temperature,
        public ?float $topP,
        public string|AssistantResponseResponseFormat $responseFormat,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, name: ?string, reasoning_effort?: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: ?string, name: string, parameters: array<string, mixed>}}>, tool_resources: ?array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}  $attributes
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

        $responseFormat = is_array($attributes['response_format']) ?
            AssistantResponseResponseFormat::from($attributes['response_format']) :
            $attributes['response_format'];

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['name'],
            $attributes['reasoning_effort'] ?? null,
            $attributes['description'],
            $attributes['model'],
            $attributes['instructions'],
            $tools,
            isset($attributes['tool_resources']) ? AssistantResponseToolResources::from($attributes['tool_resources']) : null,
            $attributes['metadata'],
            $attributes['temperature'],
            $attributes['top_p'],
            $responseFormat,
            $meta
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $response = [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'name' => $this->name,
            'reasoning_effort' => $this->reasoningEffort,
            'description' => $this->description,
            'model' => $this->model,
            'instructions' => $this->instructions,
            'tools' => array_map(fn (AssistantResponseToolCodeInterpreter|AssistantResponseToolFileSearch|AssistantResponseToolFunction $tool): array => $tool->toArray(), $this->tools),
            'tool_resources' => $this->toolResources?->toArray(),
            'metadata' => $this->metadata,
            'temperature' => $this->temperature,
            'top_p' => $this->topP,
            'response_format' => is_string($this->responseFormat) ? $this->responseFormat : $this->responseFormat->toArray(),
        ];

        // Only reasoning models will have this property.
        if (! $this->reasoningEffort) {
            unset($response['reasoning_effort']);
        }

        return $response;
    }
}
