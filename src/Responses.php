<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ResponsesContract;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItemsResponse;
use OpenAI\Responses\Responses\ListResponse;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Resources\Concerns\Transportable;
use OpenAI\Contracts\StringableContract;
use OpenAI\Responses\Responses\PartialResponses\CreatedPartialResponse; // Import PartialResponse

/**
 * @internal
 */
final class Responses implements ResponsesContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    /** 
     * {@inheritDoc}
     */
    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        $payload = Payload::create('responses', $parameters);

        /** @var array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $result */
        $response = $this->transporter->requestObject($payload);

        $metaData = $response->meta()->toArray(); // Assuming MetaInformation has a toArray() method
        
        return CreateResponse::from($response->data(), $metaData);

    }

    /**
     * {@inheritDoc}
     *
     * @return \OpenAI\Responses\Responses\CreateStreamedResponse
     */
    public function createStreamed(array $parameters): CreateStreamedResponse
    {

        $payload = Payload::createStreamed('responses', $parameters);

        /** @var array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $result */
        $response = $this->transporter->requestObject($payload);

        $metaData = $response->meta()->toArray(); // Assuming MetaInformation has a toArray() method
        
        return CreateStreamedResponse::from($response->data(), $metaData);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve(string $id): RetrieveResponse
    {
        $payload = Payload::retrieve('responses', $id);

        /** @var array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $result */
        $response = $this->transporter->requestObject($payload);

        $metaData = $response->meta()->toArray(); // Assuming MetaInformation has a toArray() method
        
        return RetrieveResponse::from($response->data(), $metaData);

    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $id): DeleteResponse
    {
        $payload = Payload::delete('responses', $id);

        /** @var array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $result */
        $response = $this->transporter->requestObject($payload);

        $metaData = $response->meta()->toArray(); // Assuming MetaInformation has a toArray() method
        
        return DeleteResponse::from($response->data(), $metaData);

    }

    /**
     * {@inheritDoc}
     * attribute input_items is only used for ListInputItemsResponse and not for create response
     */
    public function listInputItems(string $id, array $parameters): ListInputItemsResponse
    {
        $payload = Payload::listInputItems('responses', $id , $parameters);

        /** @var array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $result */
        $response = $this->transporter->requestObject($payload);

        $metaData = $response->meta()->toArray(); // Assuming MetaInformation has a toArray() method
        
        return ListInputItemsResponse::from($response->data(), $metaData);

    }


    /**
     * {@inheritDoc}
     */
    public function list(array $parameters): ListResponse
    {
        $payload = Payload::list('responses', $parameters);

        /** @var array{id: string, object: string, created_at: int, status: string, error: ?array<string, mixed>, incomplete_details: ?array<string, mixed>, instructions: ?string, max_output_tokens: ?int, model: string, output: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: string, text: string, annotations: array<mixed>}>}>, parallel_tool_calls: bool, previous_response_id: ?string, reasoning: array<string, mixed>, store: bool, temperature: ?float, text: array{format: array{type: string}}, tool_choice: string, tools: array<mixed>, top_p: ?float, truncation: string, usage: array{input_tokens: int, input_tokens_details: array<string, int>, output_tokens: int, output_tokens_details: array<string, int>, total_tokens: int}, user: ?string, metadata: array<string, string>} $result */
        $response = $this->transporter->requestObject($payload);

        $metaData = $response->meta()->toArray(); // Assuming MetaInformation has a toArray() method
        
        return ListResponse::from($response->data(), $metaData);

    }
    
}