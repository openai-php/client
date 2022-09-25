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
        $result = $this->transporter->request($payload);

        return $result;
    }
}
