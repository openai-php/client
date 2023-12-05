<?php

namespace OpenAI\Events;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseStreamContract;
use OpenAI\ValueObjects\Transporter\Payload;

class RequestHandled
{
    public function __construct(
        public readonly Payload $payload,
        public readonly ResponseContract|ResponseStreamContract|string $response,
    )
    {
    }
}
