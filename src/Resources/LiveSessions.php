<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\LiveSessionsContract;
use OpenAI\Responses\Live\Sessions\CreateResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type CreateResponseType from CreateResponse
 */
final class LiveSessions implements LiveSessionsContract
{
    use Concerns\Transportable;

    /**
     * {@inheritDoc}
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('live/sessions', $parameters);

        /** @var Response<CreateResponseType> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }

    public function hangup(string $sessionId): void
    {
        $payload = Payload::create('live/sessions/'.rawurlencode($sessionId).'/hangup', null);

        $this->transporter->requestContent($payload, requireSuccess: true);
    }
}
