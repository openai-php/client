<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ResponsesContract;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;
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

        /** @var Response<array{id: string, object: string, created_at: int, status: string, error: object|null, incomplete_details: object|null, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata?: array<string, string>}> $response */
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