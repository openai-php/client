<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\FilesContract;
use OpenAI\Events\RequestHandled;
use OpenAI\Responses\Files\CreateResponse;
use OpenAI\Responses\Files\DeleteResponse;
use OpenAI\Responses\Files\ListResponse;
use OpenAI\Responses\Files\RetrieveResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Files implements FilesContract
{
    use Concerns\Transportable;

    /**
     * Returns a list of files that belong to the user's organization.
     *
     * @see https://platform.openai.com/docs/api-reference/files/list
     */
    public function list(): ListResponse
    {
        $payload = Payload::list('files');

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ListResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Returns information about a specific file.
     *
     * @see https://platform.openai.com/docs/api-reference/files/retrieve
     */
    public function retrieve(string $file): RetrieveResponse
    {
        $payload = Payload::retrieve('files', $file);

        /** @var Response<array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = RetrieveResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Returns the contents of the specified file.
     *
     * @see https://platform.openai.com/docs/api-reference/files/retrieve-content
     */
    public function download(string $file): string
    {
        $payload = Payload::retrieveContent('files', $file);

        $response = $this->transporter->requestContent($payload);

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Upload a file that contains document(s) to be used across various endpoints/features.
     *
     * @see https://platform.openai.com/docs/api-reference/files/upload
     *
     * @param  array<string, mixed>  $parameters
     */
    public function upload(array $parameters): CreateResponse
    {
        $payload = Payload::upload('files', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = CreateResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Delete a file.
     *
     * @see https://platform.openai.com/docs/api-reference/files/delete
     */
    public function delete(string $file): DeleteResponse
    {
        $payload = Payload::delete('files', $file);

        /** @var Response<array{id: string, object: string, deleted: bool}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = DeleteResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }
}
