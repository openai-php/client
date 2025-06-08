<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\RealtimeContract;
use OpenAI\Resources\Realtime;
use OpenAI\Responses\Realtime\SessionResponse;
use OpenAI\Responses\Realtime\TranscriptionSessionResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class RealtimeTestResource implements RealtimeContract
{
    use Testable;

    public function resource(): string
    {
        return Realtime::class;
    }

    public function token(array $parameters = []): SessionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function transcribeToken(array $parameters = []): TranscriptionSessionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
