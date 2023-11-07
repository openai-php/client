<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AssistantContract;
use OpenAI\Contracts\Resources\ImagesContract;
use OpenAI\Responses\Assistant\AssistantResponse;
use OpenAI\Responses\Assistant\DeleteResponse;
use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Assistant implements AssistantContract
{
    use Concerns\Transportable;

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

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
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

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/modifyAssistant
     *
     * @param array<string, mixed> $parameters
     */
    public function modify(string $id, array $parameters): AssistantResponse
    {
        $payload = Payload::modify('assistants', $id, $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an assistant.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/deleteAssistant
     */
    public function delete(string $id): DeleteResponse
    {
        $payload = Payload::delete('assistants', $id);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data(), $response->meta());
    }
}
