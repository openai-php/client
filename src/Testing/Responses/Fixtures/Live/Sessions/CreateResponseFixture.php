<?php

declare(strict_types=1);

namespace OpenAI\Testing\Responses\Fixtures\Live\Sessions;

final class CreateResponseFixture
{
    public const ATTRIBUTES = [
        'session' => ['id' => 'live_123'],
        'transport' => ['type' => 'sip'],
    ];
}
