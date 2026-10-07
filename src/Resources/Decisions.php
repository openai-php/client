<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\DecisionsContract;
use OpenAI\Responses\Decisions\CreateResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type CreateResponseType from CreateResponse
 */
final class Decisions implements DecisionsContract
{
    use Concerns\Transportable;

    /**
     * Evaluates text, images, or both against a list of questions.
     *
     * @see https://developers.openai.com/api/docs/guides/decisions
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('decisions', $parameters);

        /** @var Response<CreateResponseType> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }
}
