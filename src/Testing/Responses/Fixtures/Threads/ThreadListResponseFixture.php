<?php

namespace OpenAI\Testing\Responses\Fixtures\Threads;

final class ThreadListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
                'object' => 'thread',
                'created_at' => 1_699_621_778,
                'metadata' => [],
            ],
        ],
        'first_id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
        'last_id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
        'has_more' => false,
    ];
}
