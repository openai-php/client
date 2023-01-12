<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use Generator;
use OpenAI\Responses\Completions\CreateResponse;
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
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('completions', $parameters);

        $response = $this->transporter->requestObject($payload);

        if ($response->isStream()) {
            return CreateResponse::fromStream($response->stream());
        }

        return CreateResponse::from($response->object());
    }
}
