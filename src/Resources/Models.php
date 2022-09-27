<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\ValueObjects\Transporter\Payload;

final class Models
{
    use Concerns\Transportable;

    /**
     * Lists the currently available models, and provides basic information about each one such as the owner and availability.
     *
     * @see https://beta.openai.com/docs/api-reference/models/list
     *
     * @return array<string, array<int, array<string, mixed>>>
     */
    public function list(): array
    {
        $payload = Payload::list('models');

        /** @var array<string, array<int, array<string, mixed>>> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }

    /**
     * Retrieves a model instance, providing basic information about the model such as the owner and permissioning.
     *
     * @see https://beta.openai.com/docs/api-reference/models/retrieve
     *
     * @return array<string, mixed>
     */
    public function retrieve(string $model): array
    {
        $payload = Payload::retrieve('models', $model);

        return $this->transporter->requestObject($payload);
    }
}
