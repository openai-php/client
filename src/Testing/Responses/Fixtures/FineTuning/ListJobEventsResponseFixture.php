<?php

namespace OpenAI\Testing\Responses\Fixtures\FineTuning;

final class ListJobEventsResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'object' => 'fine_tuning.job.event',
                'id' => 'ft-event-ddTJfwuMVpfLXseO0Am0Gqjm',
                'created_at' => 1_692_407_401,
                'level' => 'info',
                'message' => 'Fine tuning job successfully completed',
                'data' => null,
                'type' => 'message',
            ],
        ],
        'has_more' => false,
    ];
}
