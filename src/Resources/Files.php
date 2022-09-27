<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\ValueObjects\Transporter\Payload;

final class Files
{
    use Concerns\Transportable;

    /**
     * Returns a list of files that belong to the user's organization.
     *
     * @see https://beta.openai.com/docs/api-reference/files/list
     *
     * @return array<string, array<int, array<string, mixed>>>
     */
    public function list(): array
    {
        $payload = Payload::list('files');

        /** @var array<string, array<int, array<string, mixed>>> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }

    /**
     * Returns information about a specific file.
     *
     * @see https://beta.openai.com/docs/api-reference/files/retrieve
     *
     * @return array<string, mixed>
     */
    public function retrieve(string $file): array
    {
        $payload = Payload::retrieve('files', $file);

        return $this->transporter->requestObject($payload);
    }

    /**
     * Returns the contents of the specified file.
     *
     * @see https://beta.openai.com/docs/api-reference/files/retrieve-content
     */
    public function download(string $file): string
    {
        $payload = Payload::retrieveContent('files', $file);

        return $this->transporter->requestContent($payload);
    }

    /**
     * Upload a file that contains document(s) to be used across various endpoints/features.
     *
     * @see https://beta.openai.com/docs/api-reference/files/upload
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, array<string, mixed>|string>
     */
    public function upload(array $parameters): array
    {
        $payload = Payload::upload('files', $parameters);

        /** @var array<string, array<string, mixed>|string> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }

    /**
     * Delete a file.
     *
     * @see https://beta.openai.com/docs/api-reference/files/delete
     *
     * @return array<string, mixed>
     */
    public function delete(string $file): array
    {
        $payload = Payload::delete('files', $file);

        return $this->transporter->requestObject($payload);
    }
}
