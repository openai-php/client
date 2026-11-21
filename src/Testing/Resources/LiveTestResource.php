<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\LiveContract;
use OpenAI\Contracts\Resources\LiveSessionsContract;
use OpenAI\Resources\Live;
use OpenAI\Testing\Resources\Concerns\Testable;

final class LiveTestResource implements LiveContract
{
    use Testable;

    public function resource(): string
    {
        return Live::class;
    }

    public function sessions(): LiveSessionsContract
    {
        return new LiveSessionsTestResource($this->fake);
    }
}
