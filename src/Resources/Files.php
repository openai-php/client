<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use Exception;
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
        $result = $this->transporter->request($payload);

        return $result;
    }

    /**
     * Upload a file that contains document(s) to be used across various endpoints/features.
     *
     * @see https://beta.openai.com/docs/api-reference/files/upload
     *
     * @param  array<string, mixed>  $parameters
     */
    public function upload(array $parameters): never
    {
        throw new Exception('Not implemented yet.');
    }

    /**
     * Delete a file.
     *
     * @see https://beta.openai.com/docs/api-reference/files/delete
     */
    public function delete(string $file): never
    {
        throw new Exception('Not implemented yet.');
    }

    /**
     *Returns information about a specific file.
     *
     * @see https://beta.openai.com/docs/api-reference/files/retrieve
     *
     * @return array<string, mixed>
     */
    public function retrieve(string $file): void
    {
        throw new Exception('Not implemented yet.');
    }

    /**
     * Returns the contents of the specified file
     *
     * @see https://beta.openai.com/docs/api-reference/files/retrieve-content
     *
     * @return array<string, mixed>
     */
    public function download(string $file): void
    {
        throw new Exception('Not implemented yet.');
    }
}
