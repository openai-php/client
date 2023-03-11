<?php

namespace OpenAI\Testing\Responses\Fixtures\FineTunes;

final class ListEventsResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'object' => 'fine-tune-event',
                'created_at' => 1_614_807_352,
                'level' => 'info',
                'message' => 'Job enqueued. Waiting for jobs ahead to complete. Queue number =>  0.',
            ],
        ],
    ];
}
