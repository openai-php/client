<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Factories\Responses\Moderations\CreateResponseFactory;
use OpenAI\Responses\Moderations\CreateResponse;
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
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('moderations', $parameters);

        /** @var array<string, array<array-key, array<string, array<string, bool|float>>>|string> $result */
        $result = $this->transporter->requestObject($payload);

        return CreateResponseFactory::new($result);
    }
}
