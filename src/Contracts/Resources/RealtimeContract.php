<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;

interface RealtimeContract
{
    /**
     * Create an ephemeral API token for real time sessions.
     *
     * @see https://platform.openai.com/docs/api-reference/realtime-sessions/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function token(array $parameters = []): SessionResponse;

    /**
     * Create an ephemeral API token for real time transcription sessions.
     *
     * @see https://platform.openai.com/docs/api-reference/realtime-sessions/create-transcription
     *
     * @param  array<string, mixed>  $parameters
     */
    public function transcribeToken(array $parameters = []): TranscriptionSessionResponse;
}
