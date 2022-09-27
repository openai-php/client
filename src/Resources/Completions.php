<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\ValueObjects\Transporter\Payload;

final class Completions
{
    use Concerns\Transportable;

    /**
     * Creates a completion for the provided prompt and parameters
     *
     * @see https://beta.openai.com/docs/api-reference/completions/create-completion
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, array<string, mixed>|string>
     */
    public function create(array $parameters): array
    {
        $payload = Payload::create('completions', $parameters);

        /** @var array<string, array<string, mixed>|string> $result */
        $result = $this->transporter->requestObject($payload);

        return $result;
    }
}
