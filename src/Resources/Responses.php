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

/**
 * @phpstan-import-type CreateResponseType from CreateResponse
 * @phpstan-import-type RetrieveResponseType from RetrieveResponse
 * @phpstan-import-type ListInputItemsType from ListInputItems
 */
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

        /** @var Response<CreateResponseType> $response */
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

        /** @var Response<RetrieveResponseType> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveResponse::from($response->data(), $response->meta());
    }

    /**
     * Cancels a model response with the given ID. Must be marked as 'background' to be cancellable.
     *
     * @see https://platform.openai.com/docs/api-reference/responses/cancel
     */
    public function cancel(string $id): RetrieveResponse
    {
        $payload = Payload::cancel('responses', $id);

        /** @var Response<RetrieveResponseType> $response */
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

        /** @var Response<ListInputItemsType> $response */
        $response = $this->transporter->requestObject($payload);

        return ListInputItems::from($response->data(), $response->meta());
    }

    /**
     * Manage conversations to store and retrieve conversation state across Response API calls.
     */
    public function conversations(): Conversations
    {
        return new Conversations($this->transporter);
    }
}
