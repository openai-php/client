<?php

declare(strict_types=1);

namespace OpenAI\Testing\Responses\Fixtures\Realtime;

final class ClientSecretResponseFixture
{
    public const ATTRIBUTES = [
        'value' => 'ek_test_secret',
        'expires_at' => 1756310470,
        'session' => [
            'id' => 'sess_test',
            'object' => 'realtime.session',
            'type' => 'realtime',
            'model' => 'gpt-realtime-2.1',
            'output_modalities' => ['audio'],
            'audio' => [
                'output' => [
                    'voice' => 'alloy',
                ],
            ],
        ],
    ];
}
