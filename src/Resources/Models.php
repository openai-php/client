<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ModelsContract;
use OpenAI\Events\RequestHandled;
use OpenAI\Responses\Models\DeleteResponse;
use OpenAI\Responses\Models\ListResponse;
use OpenAI\Responses\Models\RetrieveResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Models extends Resource implements ModelsContract
{
    /**
     * Lists the currently available models, and provides basic information about each one such as the owner and availability.
     *
     * @see https://platform.openai.com/docs/api-reference/models/list
     */
    public function list(): ListResponse
    {
        $payload = Payload::list('models');

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created: int, owned_by: string}>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ListResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Retrieves a model instance, providing basic information about the model such as the owner and permissioning.
     *
     * @see https://platform.openai.com/docs/api-reference/models/retrieve
     */
    public function retrieve(string $model): RetrieveResponse
    {
        $payload = Payload::retrieve('models', $model);

        /** @var Response<array{id: string, object: string, created: int, owned_by: string}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = RetrieveResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Delete a fine-tuned model. You must have the Owner role in your organization.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes/delete-model
     */
    public function delete(string $model): DeleteResponse
    {
        $payload = Payload::delete('models', $model);

        /** @var Response<array{id: string, object: string, deleted: bool}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = DeleteResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }
}
