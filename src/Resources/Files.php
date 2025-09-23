<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\FilesContract;
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
    public function list(array $parameters = []): ListResponse
    {
        $payload = Payload::list('files', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: ?int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, first_id: ?string, last_id: ?string, has_more: ?bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns information about a specific file.
     *
     * @see https://platform.openai.com/docs/api-reference/files/retrieve
     */
    public function retrieve(string $file): RetrieveResponse
    {
        $payload = Payload::retrieve('files', $file);

        /** @var Response<array{id: string, object: string, created_at: int, bytes: ?int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns the contents of the specified file.
     *
     * @see https://platform.openai.com/docs/api-reference/files/retrieve-content
     */
    public function download(string $file): string
    {
        $payload = Payload::retrieveContent('files', $file);

        return $this->transporter->requestContent($payload);
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

        /** @var Response<array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete a file.
     *
     * @see https://platform.openai.com/docs/api-reference/files/delete
     */
    public function delete(string $file): DeleteResponse
    {
        $payload = Payload::delete('files', $file);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data(), $response->meta());
    }
}
