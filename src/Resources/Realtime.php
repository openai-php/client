<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\RealtimeContract;
use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type SessionType from SessionResponse
 * @phpstan-import-type TranscriptionSessionType from TranscriptionSessionResponse
 */
final class Realtime implements RealtimeContract
{
    use Concerns\Transportable;

    /**
     * Create an ephemeral API token for real time sessions.
     *
     * @see https://platform.openai.com/docs/api-reference/realtime-sessions/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function token(array $parameters = []): SessionResponse
    {
        $payload = Payload::create('realtime/sessions', $parameters);

        /** @var Response<SessionType> $response */
        $response = $this->transporter->requestObject($payload);

        return SessionResponse::from($response->data());
    }

    /**
     * Create an ephemeral API token for real time transcription sessions.
     *
     * @see https://platform.openai.com/docs/api-reference/realtime-sessions/create-transcription
     *
     * @param  array<string, mixed>  $parameters
     */
    public function transcribeToken(array $parameters = []): TranscriptionSessionResponse
    {
        $payload = Payload::create('realtime/transcription_sessions', $parameters);

        /** @var Response<TranscriptionSessionType> $response */
        $response = $this->transporter->requestObject($payload);

        return TranscriptionSessionResponse::from($response->data());
    }
}
