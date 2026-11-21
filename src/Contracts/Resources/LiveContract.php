<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

interface LiveContract
{
    /**
     * Manage Live sessions.
     */
    public function sessions(): LiveSessionsContract;
}
