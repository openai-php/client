<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ResponsesContract;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Responses implements ResponsesContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    /**
     * Creates a model response. Provide text or image inputs to generate text or JSON outputs.
     * Have the model call your own custom code or use built-in tools like web search or file search
     * to use your own data as input for the model's response.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        $payload = Payload::create('responses', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: array{code: string, message: string}|null, incomplete_details: array{reason: string}|null, instructions: string|null, max_output_tokens: int|null, model: string, output: array<int, array{content: array<int, array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}|array{refusal: string, type: 'refusal'}>, id: string, role: string, status: 'in_progress'|'completed'|'incomplete', type: 'message'}|array{id: string, queries: array<string>, status: 'in_progress'|'searching'|'incomplete'|'failed', type: 'file_search_call', results: ?array<int, array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}>}|array{arguments: string, call_id: string, name: string, type: 'function_call', id: string, status: 'in_progress'|'completed'|'incomplete'}|array{id: string, status: string, type: 'web_search_call'}|array{action: array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: float, y: float}|array{type: 'double_click', x: float, y: float}|array{path: array<int, array{x: int, y: int}>, type: 'drag'}|array{keys: array<int, string>, type: 'keypress'}|array{type: 'move', x: int, y: int}|array{type: 'screenshot'}|array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}|array{text: string, type: 'type'}|array{type: 'wait'}, call_id: string, id: string, pending_safety_checks: array<int, array{code: string, id: string, message: string}>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}|array{id: string, summary: array<int, array{text: string, type: 'summary_text'}>, type: 'reasoning', status: 'in_progress'|'completed'|'incomplete'}>, parallel_tool_calls: bool, previous_response_id: string|null, reasoning: ?array{effort: ?string, generate_summary: ?string}, store: bool, temperature: float|null, text: array{format: array{type: 'text'}|array{name: string, schema: array<string, mixed>, type: 'json_schema', description: string, strict: ?bool}|array{type: 'json_object'}}, tool_choice: 'none'|'auto'|'required'|array{type: 'file_search'|'web_search_preview'|'computer_use_preview'}|array{name: string, type: 'function'}, tools: array<int, array{type: 'file_search', vector_store_ids: array<int, string>, filters: array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}|array{filters: array<int, array{key: string, type: 'eq'|'ne'|'gt'|'gte'|'lt'|'lte', value: string|int|bool}>, type: 'and'|'or'}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{name: string, parameters: array<string, mixed>, strict: bool, type: 'function', description: ?string}|array{display_height: int, display_width: int, environment: string, type: 'computer_use_preview'}|array{type: 'web_search_preview'|'web_search_preview_2025_03_11', search_context_size: 'low'|'medium'|'high', user_location: ?array{type: 'approximate', city: string, country: string, region: string, timezone: string}}>, top_p: float|null, truncation: 'auto'|'disabled'|null, usage: array{input_tokens: int, input_tokens_details: array{cached_tokens: int}, output_tokens: int, output_tokens_details: array{reasoning_tokens: int}, total_tokens: int}, user: string|null, metadata?: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());

    }

    /**
     * When you create a Response with stream set to true,
     * the server will emit server-sent events to the client as the Response is generated.
     *
     * @see https://platform.openai.com/docs/api-reference/responses-streaming
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::create('responses', $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }

    /**
     * Retrieves a model response with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/get
     */
    public function retrieve(string $id): RetrieveResponse
    {
        $payload = Payload::retrieve('responses', $id);

        /** @var Response<array{id: string, object: string, created_at: int, status: string, error: object|null, incomplete_details: object|null, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata?: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveResponse::from($response->data(), $response->meta());
    }

    /**
     * Deletes a model response with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/delete
     */
    public function delete(string $id): DeleteResponse
    {
        $payload = Payload::delete('responses', $id);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Lists input items for a response with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/input-items
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $id, array $parameters = []): ListInputItems
    {
        $payload = Payload::list('responses/'.$id.'/input_items', $parameters);

        /** @var Response<array{object: string, data: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ListInputItems::from($response->data(), $response->meta());
    }
}
