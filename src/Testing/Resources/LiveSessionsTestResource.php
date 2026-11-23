<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\LiveSessionsContract;
use OpenAI\Resources\LiveSessions;
use OpenAI\Responses\Live\Sessions\CreateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class LiveSessionsTestResource implements LiveSessionsContract
{
    use Testable;

    public function resource(): string
    {
        return LiveSessions::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function hangup(string $sessionId): void
    {
        $this->record(__FUNCTION__, func_get_args());
    }
}
