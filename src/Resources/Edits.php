<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\ValueObjects\Transporter\Payload;

final class Edits
{
    use Concerns\Transportable;

    /**
     * Creates a new edit for the provided input, instruction, and parameters.
     *
     * @see https://beta.openai.com/docs/api-reference/edits/create
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, array<string, mixed>|string>
     */
    public function create(array $parameters): array
    {
        $payload = Payload::create('edits', $parameters);

        /** @var array<string, array<string, mixed>|string> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }
}
