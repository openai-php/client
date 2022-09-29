<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\ValueObjects\Transporter\Payload;

final class Moderations
{
    use Concerns\Transportable;

    /**
     * Classifies if text violates OpenAI's Content Policy.
     *
     * @see https://beta.openai.com/docs/api-reference/moderations/create
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, mixed>
     */
    public function create(array $parameters): array
    {
        $payload = Payload::create('moderations', $parameters);

        /** @var array<string, mixed> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }
}
