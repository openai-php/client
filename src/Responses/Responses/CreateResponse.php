<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall as ComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall as FileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall as FunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputMessage as MessageCall;
use OpenAI\Responses\Responses\Output\OutputReasoning as ReasoningCall;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall as WebSearchToolCall;
use OpenAI\Responses\Responses\Tool\ComputerUseTool;
use OpenAI\Responses\Responses\Tool\FileSearchTool;
use OpenAI\Responses\Responses\Tool\FunctionTool;
use OpenAI\Responses\Responses\Tool\WebSearchTool;
use OpenAI\Responses\Responses\ToolChoice\FunctionToolChoice;
use OpenAI\Responses\Responses\ToolChoice\HostedToolChoice;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: array{code: string, message: string}|null, incomplete_details: array{reason: string}|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{content: array<int, array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}|array{refusal: string, type: 'refusal'}>, id: string, role: 'assistant', status: 'in_progress'|'completed'|'incomplete', type: 'message'}|array{id: string, queries: array<string>, status: 'in_progress'|'searching'|'incomplete'|'failed', type: 'file_search_call', results: ?array<int, array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}>}|array{arguments: string, call_id: string, name: string, type: 'function_call', id: string, status: 'in_progress'|'completed'|'incomplete'}|array{id: string, status: string, type: 'web_search_call'}|array{action: array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: int, y: int}|array{type: 'double_click', x: float, y: float}|array{path: array<int, array{x: int, y: int}>, type: 'drag'}|array{keys: array<int, string>, type: 'keypress'}|array{type: 'move', x: int, y: int}|array{type: 'screenshot'}|array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}|array{text: string, type: 'type'}|array{type: 'wait'}, call_id: string, id: string, pending_safety_checks: array<int, array{code: string, id: string, message: string}>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}|array{id: string, summary: array<int, array{text: string, type: 'summary_text'}>, type: 'reasoning', status: 'in_progress'|'completed'|'incomplete'}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: ?array{effort: ?string, generate_summary: ?string}, store: bool, temperature: float|null, text: array{format: array{type: 'text'}|array{name: string, schema: array<string, mixed>, type: 'json_schema', description: string, strict: ?bool}|array{type: 'json_object'}}, tool_choice: 'none'|'auto'|'required'|array{type: 'file_search'|'web_search_preview'|'computer_use_preview'}|array{name: string, type: 'function'}, tools: array<int, array{type: 'file_search', vector_store_ids: array<int, string>, filters: array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}|array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string}|array{display_height: int, display_width: int, environment: string, type: 'computer_use_preview'}|array{type: 'web_search_preview'|'web_search_preview_2025_03_11', search_context_size: 'low'|'medium'|'high', user_location: ?array{type: 'approximate', city: string, country: string, region: string, timezone: string}}>, top_p: float|null, truncation: 'auto'|'disabled'|null, usage: array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}, user: string|null, metadata?: array<string, string>}>
 */
final class CreateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: array{code: string, message: string}|null, incomplete_details: array{reason: string}|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{content: array<int, array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}|array{refusal: string, type: 'refusal'}>, id: string, role: 'assistant', status: 'in_progress'|'completed'|'incomplete', type: 'message'}|array{id: string, queries: array<string>, status: 'in_progress'|'searching'|'incomplete'|'failed', type: 'file_search_call', results: ?array<int, array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}>}|array{arguments: string, call_id: string, name: string, type: 'function_call', id: string, status: 'in_progress'|'completed'|'incomplete'}|array{id: string, status: string, type: 'web_search_call'}|array{action: array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: int, y: int}|array{type: 'double_click', x: float, y: float}|array{path: array<int, array{x: int, y: int}>, type: 'drag'}|array{keys: array<int, string>, type: 'keypress'}|array{type: 'move', x: int, y: int}|array{type: 'screenshot'}|array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}|array{text: string, type: 'type'}|array{type: 'wait'}, call_id: string, id: string, pending_safety_checks: array<int, array{code: string, id: string, message: string}>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}|array{id: string, summary: array<int, array{text: string, type: 'summary_text'}>, type: 'reasoning', status: 'in_progress'|'completed'|'incomplete'}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: ?array{effort: ?string, generate_summary: ?string}, store: bool, temperature: float|null, text: array{format: array{type: 'text'}|array{name: string, schema: array<string, mixed>, type: 'json_schema', description: string, strict: ?bool}|array{type: 'json_object'}}, tool_choice: 'none'|'auto'|'required'|array{type: 'file_search'|'web_search_preview'|'computer_use_preview'}|array{name: string, type: 'function'}, tools: array<int, array{type: 'file_search', vector_store_ids: array<int, string>, filters: array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}|array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string}|array{display_height: int, display_width: int, environment: string, type: 'computer_use_preview'}|array{type: 'web_search_preview'|'web_search_preview_2025_03_11', search_context_size: 'low'|'medium'|'high', user_location: ?array{type: 'approximate', city: string, country: string, region: string, timezone: string}}>, top_p: float|null, truncation: 'auto'|'disabled'|null, usage: array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}, user: string|null, metadata?: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'completed'|'failed'|'in_progress'|'incomplete'  $status
     * @param  array<int, MessageCall|ComputerToolCall|FileSearchToolCall|WebSearchToolCall|FunctionToolCall|ReasoningCall>  $output
     * @param  array<int, ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool>  $tools
     * @param  'auto'|'disabled'|null  $truncation
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly string $status,
        public readonly ?CreateResponseError $error,
        public readonly ?CreateResponseIncompleteDetails $incompleteDetails,
        public readonly ?string $instructions,
        public readonly ?int $maxOutputTokens,
        public readonly string $model,
        public readonly array $output,
        public readonly bool $parallelToolCalls,
        public readonly ?string $previousResponseId,
        public readonly ?CreateResponseReasoning $reasoning,
        public readonly bool $store,
        public readonly ?float $temperature,
        public readonly CreateResponseFormat $text,
        public readonly string|FunctionToolChoice|HostedToolChoice $toolChoice,
        public readonly array $tools,
        public readonly ?float $topP,
        public readonly ?string $truncation,
        public readonly CreateResponseUsage $usage,
        public readonly ?string $user,
        public readonly array $metadata,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  array{id: string, object: string, created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: array{code: string, message: string}|null, incomplete_details: array{reason: string}|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{content: array<int, array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}|array{refusal: string, type: 'refusal'}>, id: string, role: 'assistant', status: 'in_progress'|'completed'|'incomplete', type: 'message'}|array{id: string, queries: array<string>, status: 'in_progress'|'searching'|'incomplete'|'failed', type: 'file_search_call', results: ?array<int, array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}>}|array{arguments: string, call_id: string, name: string, type: 'function_call', id: string, status: 'in_progress'|'completed'|'incomplete'}|array{id: string, status: string, type: 'web_search_call'}|array{action: array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: int, y: int}|array{type: 'double_click', x: float, y: float}|array{path: array<int, array{x: int, y: int}>, type: 'drag'}|array{keys: array<int, string>, type: 'keypress'}|array{type: 'move', x: int, y: int}|array{type: 'screenshot'}|array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}|array{text: string, type: 'type'}|array{type: 'wait'}, call_id: string, id: string, pending_safety_checks: array<int, array{code: string, id: string, message: string}>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}|array{id: string, summary: array<int, array{text: string, type: 'summary_text'}>, type: 'reasoning', status: 'in_progress'|'completed'|'incomplete'}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: ?array{effort: ?string, generate_summary: ?string}, store: bool, temperature: float|null, text: array{format: array{type: 'text'}|array{name: string, schema: array<string, mixed>, type: 'json_schema', description: string, strict: ?bool}|array{type: 'json_object'}}, tool_choice: 'none'|'auto'|'required'|array{type: 'file_search'|'web_search_preview'|'computer_use_preview'}|array{name: string, type: 'function'}, tools: array<int, array{type: 'file_search', vector_store_ids: array<int, string>, filters: array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}|array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string}|array{display_height: int, display_width: int, environment: string, type: 'computer_use_preview'}|array{type: 'web_search_preview'|'web_search_preview_2025_03_11', search_context_size: 'low'|'medium'|'high', user_location: ?array{type: 'approximate', city: string, country: string, region: string, timezone: string}}>, top_p: float|null, truncation: 'auto'|'disabled'|null, usage: array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}, user: string|null, metadata?: array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $output = array_map(
            fn (array $output): MessageCall|ComputerToolCall|FileSearchToolCall|WebSearchToolCall|FunctionToolCall|ReasoningCall => match ($output['type']) {
                'message' => MessageCall::from($output),
                'file_search_call' => FileSearchToolCall::from($output),
                'function_call' => FunctionToolCall::from($output),
                'web_search_call' => WebSearchToolCall::from($output),
                'computer_call' => ComputerToolCall::from($output),
                'reasoning' => ReasoningCall::from($output),
            },
            $attributes['output'],
        );

        $toolChoice = is_array($attributes['tool_choice'])
            ? match ($attributes['tool_choice']['type']) {
                'file_search', 'web_search_preview', 'computer_use_preview' => HostedToolChoice::from($attributes['tool_choice']),
                'function' => FunctionToolChoice::from($attributes['tool_choice']),
            }
        : $attributes['tool_choice'];

        $tools = array_map(
            fn (array $tool): ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool => match ($tool['type']) {
                'file_search' => FileSearchTool::from($tool),
                'web_search_preview', 'web_search_preview_2025_03_11' => WebSearchTool::from($tool),
                'function' => FunctionTool::from($tool),
                'computer_use_preview' => ComputerUseTool::from($tool),
            },
            $attributes['tools'],
        );

        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            status: $attributes['status'],
            error: isset($attributes['error'])
                ? CreateResponseError::from($attributes['error'])
                : null,
            incompleteDetails: isset($attributes['incomplete_details'])
                ? CreateResponseIncompleteDetails::from($attributes['incomplete_details'])
                : null,
            instructions: $attributes['instructions'],
            maxOutputTokens: $attributes['max_output_tokens'],
            model: $attributes['model'],
            output: $output,
            parallelToolCalls: $attributes['parallel_tool_calls'],
            previousResponseId: $attributes['previous_response_id'],
            reasoning: isset($attributes['reasoning'])
                ? CreateResponseReasoning::from($attributes['reasoning'])
                : null,
            store: $attributes['store'],
            temperature: $attributes['temperature'],
            text: CreateResponseFormat::from($attributes['text']),
            toolChoice: $toolChoice,
            tools: $tools,
            topP: $attributes['top_p'],
            truncation: $attributes['truncation'],
            usage: CreateResponseUsage::from($attributes['usage']),
            user: $attributes['user'] ?? null,
            metadata: $attributes['metadata'] ?? [],
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
            'status' => $this->status,
            'error' => $this->error?->toArray(),
            'incomplete_details' => $this->incompleteDetails?->toArray(),
            'instructions' => $this->instructions,
            'max_output_tokens' => $this->maxOutputTokens,
            'metadata' => $this->metadata,
            'model' => $this->model,
            'output' => array_map(
                fn (MessageCall|ComputerToolCall|FileSearchToolCall|WebSearchToolCall|FunctionToolCall|ReasoningCall $output) => $output->toArray(),
                $this->output
            ),
            'parallel_tool_calls' => $this->parallelToolCalls,
            'previous_response_id' => $this->previousResponseId,
            'reasoning' => $this->reasoning?->toArray(),
            'store' => $this->store,
            'temperature' => $this->temperature,
            'text' => $this->text->toArray(),
            'tool_choice' => is_string($this->toolChoice)
                ? $this->toolChoice
                : $this->toolChoice->toArray(),
            'tools' => array_map(
                fn (ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool $tool) => $tool->toArray(),
                $this->tools
            ),
            'top_p' => $this->topP,
            'truncation' => $this->truncation,
            'usage' => $this->usage->toArray(),
            'user' => $this->user,
        ];
    }
}
