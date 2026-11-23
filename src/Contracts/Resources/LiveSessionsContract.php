<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Live\Sessions\CreateResponse;

interface LiveSessionsContract
{
    /**
     * Create a Live WebRTC session or place an outbound SIP call.
     *
     * @see https://developers.openai.com/api/reference/resources/live/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;

    /**
     * End a SIP call using its Live session ID.
     *
     * @see https://developers.openai.com/api/reference/resources/live/subresources/sessions/methods/hangup
     */
    public function hangup(string $sessionId): void;
}
