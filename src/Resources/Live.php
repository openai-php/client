<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\LiveContract;
use OpenAI\Contracts\Resources\LiveSessionsContract;

final class Live implements LiveContract
{
    use Concerns\Transportable;

    public function sessions(): LiveSessionsContract
    {
        return new LiveSessions($this->transporter);
    }
}
