<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AssistantsContract;
use OpenAI\Responses\Assistants\AssistantDeleteResponse;
use OpenAI\Responses\Assistants\AssistantListResponse;
use OpenAI\Responses\Assistants\AssistantResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Assistants implements AssistantsContract
{
    use Concerns\Transportable;

    /**
     * Create an assistant with a model and instructions.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/createAssistant
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AssistantResponse
    {
        $payload = Payload::create('assistants', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, reasoning_effort?: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/getAssistant
     */
    public function retrieve(string $id): AssistantResponse
    {
        $payload = Payload::retrieve('assistants', $id);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, reasoning_effort?: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/modifyAssistant
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): AssistantResponse
    {
        $payload = Payload::modify('assistants', $id, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, reasoning_effort?: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/deleteAssistant
     */
    public function delete(string $id): AssistantDeleteResponse
    {
        $payload = Payload::delete('assistants', $id);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of assistants.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/listAssistants
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AssistantListResponse
    {
        $payload = Payload::list('assistants', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, name: ?string, reasoning_effort?: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantListResponse::from($response->data(), $response->meta());
    }
}
