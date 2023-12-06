<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AssistantsContract;
use OpenAI\Contracts\Resources\AssistantsFilesContract;
use OpenAI\Events\RequestHandled;
use OpenAI\Responses\Assistants\AssistantDeleteResponse;
use OpenAI\Responses\Assistants\AssistantListResponse;
use OpenAI\Responses\Assistants\AssistantResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Assistants extends Resource implements AssistantsContract
{
    /**
     * Create an assistant with a model and instructions.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/object
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AssistantResponse
    {
        $payload = Payload::create('assistants', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = AssistantResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Retrieves an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/getAssistant
     */
    public function retrieve(string $id): AssistantResponse
    {
        $payload = Payload::retrieve('assistants', $id);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = AssistantResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = AssistantResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Delete an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/deleteAssistant
     */
    public function delete(string $id): AssistantDeleteResponse
    {
        $payload = Payload::delete('assistants', $id);

        /** @var Response<array{id: string, object: string, deleted: bool}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = AssistantDeleteResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = AssistantListResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Manage files attached to an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants
     */
    public function files(): AssistantsFilesContract
    {
        return new AssistantsFiles($this->transporter, $this->events);
    }
}
